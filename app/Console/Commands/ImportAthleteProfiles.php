<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\FetchWorldClimbingAthleteProfile;
use App\Enums\IocCountryCode;
use App\Models\Athlete;
use App\Models\Country;
use Illuminate\Console\Command;

final class ImportAthleteProfiles extends Command
{
    protected $signature = 'app:import-athlete-profiles
        {--athlete= : IFSC athlete ID to import a single profile.}
        {--limit= : Maximum number of athletes to process.}';

    protected $description = 'Fetch and update athlete profiles from worldclimbing.com';

    public function handle(FetchWorldClimbingAthleteProfile $fetcher): int
    {
        $athletes = $this->getAthletes();

        if ($athletes->isEmpty()) {
            $this->warn('No athletes found to process.');

            return self::SUCCESS;
        }

        $this->info("Processing {$athletes->count()} athlete(s)...");

        $updated = 0;
        $failed = 0;

        foreach ($athletes as $athlete) {
            $label = "{$athlete->firstname} {$athlete->lastname} (#{$athlete->ifsc_id})";
            $this->comment("Fetching {$label}...");

            $data = $fetcher->handle($athlete->ifsc_id, $athlete->firstname, $athlete->lastname);

            if ($data === null) {
                $this->warn("  No data returned for {$label}. Skipping.");
                $failed++;

                continue;
            }

            $this->updateAthlete($athlete, $data);
            $updated++;
            $this->info("  Updated {$label}.");
        }

        $this->newLine();
        $this->table(
            ['Metric', 'Count'],
            [
                ['Processed', $athletes->count()],
                ['Updated', $updated],
                ['Failed', $failed],
            ],
        );

        $this->info('Import complete.');

        return self::SUCCESS;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Athlete>
     */
    private function getAthletes(): \Illuminate\Database\Eloquent\Collection
    {
        $ifscId = $this->option('athlete');

        if (is_string($ifscId)) {
            return Athlete::query()
                ->where('ifsc_id', (int) $ifscId)
                ->get();
        }

        $query = Athlete::query()->orderBy('id');

        $limit = $this->option('limit');

        if (is_string($limit)) {
            $query->limit((int) $limit);
        }

        return $query->get();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function updateAthlete(Athlete $athlete, array $data): void
    {
        $athlete->update(array_filter([
            'photo_url' => $data['photo_url'] ?? $athlete->photo_url,
            'federation_id' => $data['federation']['id'] ?? $athlete->federation_id,
            'country_id' => $this->resolveCountryId($data['country'] ?? null) ?? $athlete->country_id,
            'birthday' => $data['birthday'] ?? $athlete->birthday,
            'height' => $data['height'] ?? $athlete->height,
        ]));
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
