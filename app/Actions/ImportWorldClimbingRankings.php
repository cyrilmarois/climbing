<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Discipline;
use App\Enums\IocCountryCode;
use App\Models\Athlete;
use App\Models\AthleteRanking;
use App\Models\Country;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

final readonly class ImportWorldClimbingRankings
{
    /**
     * @param  array{
     *     events?: list<array<string, mixed>>,
     *     ranking?: list<array<string, mixed>>,
     *     discipline_kind?: string,
     * }  $data
     * @return array{events: int, athletes: int, rankings: int}
     */
    public function handle(array $data, Discipline $discipline): array
    {
        return DB::transaction(function () use ($data, $discipline): array {
            $eventMap = $this->importEvents($data['events'] ?? [], $discipline);
            $stats = $this->importAthletesAndRankings($data['ranking'] ?? [], $eventMap);

            return [
                'events' => count($eventMap),
                'athletes' => $stats['athletes'],
                'rankings' => $stats['rankings'],
            ];
        });
    }

    /**
     * @param  list<array<string, mixed>>  $events
     * @return array<int, int> Map of IFSC event_id => local Event id
     */
    private function importEvents(array $events, Discipline $discipline): array
    {
        $eventMap = [];

        foreach ($events as $eventData) {
            $location = $eventData['location'] ?? '';
            $city = str_contains($location, ',') ? mb_trim(explode(',', $location)[0]) : $location;
            $countryIoc = str_contains($location, ',') ? mb_trim(explode(',', $location, 2)[1]) : null;
            $countryId = $this->resolveCountryId($countryIoc);

            $event = Event::query()->updateOrCreate(
                ['title' => $eventData['name']],
                [
                    'type' => 'competition',
                    'division' => 'international',
                    'discipline' => $discipline,
                    'date' => $eventData['starts_at'],
                    'city' => $city,
                    'country_id' => $countryId,
                ],
            );

            $eventMap[$eventData['id']] = $event->id;
        }

        return $eventMap;
    }

    /**
     * @param  list<array<string, mixed>>  $rankings
     * @param  array<int, int>  $eventMap
     * @return array{athletes: int, rankings: int}
     */
    private function importAthletesAndRankings(array $rankings, array $eventMap): array
    {
        $athleteCount = 0;
        $rankingCount = 0;

        foreach ($rankings as $athleteData) {
            $countryId = $this->resolveCountryId($athleteData['country'] ?? null);

            $athlete = Athlete::query()->updateOrCreate(
                ['ifsc_id' => $athleteData['athlete_id']],
                [
                    'firstname' => $athleteData['firstname'],
                    'lastname' => $athleteData['lastname'],
                    'country_id' => $countryId,
                    'federation_id' => $athleteData['federation_id'] ?? null,
                    'photo_url' => $athleteData['photo_url'] ?? null,
                ],
            );

            $athleteCount++;

            foreach ($athleteData['score_breakdown'] ?? [] as $result) {
                $localEventId = $eventMap[$result['event_id']] ?? null;

                if ($localEventId === null) {
                    continue;
                }

                AthleteRanking::query()->updateOrCreate(
                    [
                        'athlete_id' => $athlete->id,
                        'event_id' => $localEventId,
                    ],
                    [
                        'rank' => $result['rank'] ?? null,
                        'score' => $result['gained_pts'] ?? null,
                    ],
                );

                $rankingCount++;
            }
        }

        return ['athletes' => $athleteCount, 'rankings' => $rankingCount];
    }

    private function resolveCountryId(?string $iocCode): ?int
    {
        if ($iocCode === null || $iocCode === '') {
            return null;
        }

        $iso2 = IocCountryCode::toIso2(mb_trim($iocCode));

        if ($iso2 === null) {
            return null;
        }

        return Country::query()
            ->where('code', $iso2)
            ->value('id');
    }
}
