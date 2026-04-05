<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Discipline;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

final readonly class FetchWorldClimbingRankings
{
    private const string BASE_URL = 'https://www.worldclimbing.com/rankings/index';

    /**
     * @return array{
     *     dcat_name: string,
     *     discipline_kind: string,
     *     ranking_name: string,
     *     events: list<array<string, mixed>>,
     *     ranking: list<array<string, mixed>>
     * }|null
     *
     * @throws ConnectionException
     */
    public function handle(Discipline $discipline, string $category): ?array
    {
        $response = Http::withHeaders([
            'RSC' => '1',
            'Next-Url' => '/rankings/index',
            'Next-Action' => '40046403c2b5e569007d2d6f9cc3677b71f9e62eaf',
        ])->withBody(json_encode([['dcat_id' => 3]]), 'text/plain;charset=UTF-8')
            ->post(self::BASE_URL.'?'.http_build_query([
                'discipline' => $this->mapDiscipline($discipline),
                'category' => $category,
            ]));

        if ($response->failed()) {
            return null;
        }

        return $this->parseRscResponse($response->body());
    }

    /**
     * @return array<string, mixed>|null
     */
    private function parseRscResponse(string $body): ?array
    {
        // dd($body);
        foreach (explode("\n", $body) as $line) {
            if (! str_starts_with($line, '1:')) {
                continue;
            }

            $json = json_decode(mb_substr($line, 2), true);
            if (is_array($json) && isset($json['data'])) {
                return $json['data'];
            }
        }

        return null;
    }

    private function mapDiscipline(Discipline $discipline): string
    {
        return match ($discipline) {
            Discipline::Bloc => 'boulder',
            Discipline::Lead => 'lead',
            Discipline::Speed => 'speed',
        };
    }
}
