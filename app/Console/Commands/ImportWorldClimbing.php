<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\FetchWorldClimbingRankings;
use App\Actions\ImportWorldClimbingRankings;
use App\Enums\Discipline;
use Illuminate\Console\Command;

final class ImportWorldClimbing extends Command
{
    protected $signature = 'app:import-world-climbing
        {--discipline= : Discipline to import (bloc, lead, speed). Imports all if omitted.}
        {--category= : Category to import (men, women). Imports both if omitted.}
        {--file= : Path to a JSON file containing the ranking data (skips HTTP fetch).}';

    protected $description = 'Import rankings from worldclimbing.com';

    public function handle(
        ImportWorldClimbingRankings $importer,
        FetchWorldClimbingRankings $fetcher,
    ): int {
        $file = $this->option('file');

        if (is_string($file)) {
            return $this->importFromFile($file, $importer);
        }

        return $this->importFromApi($importer, $fetcher);
    }

    private function importFromFile(string $path, ImportWorldClimbingRankings $importer): int
    {
        if (! file_exists($path)) {
            $this->error("File not found: {$path}");

            return self::FAILURE;
        }

        $raw = file_get_contents($path);

        if ($raw === false) {
            $this->error("Could not read file: {$path}");

            return self::FAILURE;
        }

        $data = $this->parseJsonData($raw);

        if ($data === null) {
            $this->error('Invalid JSON or missing "data" key.');

            return self::FAILURE;
        }

        $discipline = $this->resolveDisciplineFromData($data);

        if ($discipline === null) {
            $this->error('Could not determine discipline. Use --discipline option.');

            return self::FAILURE;
        }

        $this->info("Importing from file ({$discipline->value})...");

        $stats = $importer->handle($data, $discipline);
        $this->printStats($stats);

        $this->info('Import complete.');

        return self::SUCCESS;
    }

    private function importFromApi(
        ImportWorldClimbingRankings $importer,
        FetchWorldClimbingRankings $fetcher,
    ): int {
        $disciplines = $this->getDisciplines();
        $categories = $this->getCategories();

        foreach ($disciplines as $discipline) {
            foreach ($categories as $category) {
                $label = $discipline->value.' '.$category;
                $this->info("Fetching {$label}...");

                $data = $fetcher->handle($discipline, $category);
                if ($data === null) {
                    $this->warn("No data returned for {$label}. Skipping.");

                    continue;
                }

                $this->info("Importing {$label}...");
                $stats = $importer->handle($data, $discipline);
                $this->printStats($stats);
            }
        }

        $this->info('Import complete.');

        return self::SUCCESS;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function parseJsonData(string $raw): ?array
    {
        $raw = mb_trim($raw);

        // Handle RSC format: lines prefixed with "1:", "2:", etc.
        if (preg_match('/^\d+:/', $raw)) {
            foreach (explode("\n", $raw) as $line) {
                if (preg_match('/^\d+:(.+)$/', $line, $matches)) {
                    $decoded = json_decode($matches[1], true);

                    if (is_array($decoded) && isset($decoded['data'])) {
                        return $decoded['data'];
                    }
                }
            }

            return null;
        }

        $decoded = json_decode($raw, true);

        if (! is_array($decoded)) {
            return null;
        }

        // Direct data object
        if (isset($decoded['ranking'])) {
            return $decoded;
        }

        // Wrapped in {"data": {...}}
        if (isset($decoded['data']) && is_array($decoded['data'])) {
            return $decoded['data'];
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolveDisciplineFromData(array $data): ?Discipline
    {
        $option = $this->option('discipline');

        if (is_string($option)) {
            return Discipline::tryFrom($option);
        }

        $kind = $data['discipline_kind'] ?? null;

        return match ($kind) {
            'boulder' => Discipline::Bloc,
            'lead' => Discipline::Lead,
            'speed' => Discipline::Speed,
            default => null,
        };
    }

    /**
     * @param  array{events: int, athletes: int, rankings: int}  $stats
     */
    private function printStats(array $stats): void
    {
        $this->table(
            ['Metric', 'Count'],
            [
                ['Events', $stats['events']],
                ['Athletes', $stats['athletes']],
                ['Rankings', $stats['rankings']],
            ],
        );
    }

    /** @return list<Discipline> */
    private function getDisciplines(): array
    {
        $option = $this->option('discipline');

        if (is_string($option)) {
            $discipline = Discipline::tryFrom($option);

            if ($discipline === null) {
                $this->error("Invalid discipline: {$option}. Use bloc, lead, or speed.");

                return [];
            }

            return [$discipline];
        }

        return Discipline::cases();
    }

    /** @return list<string> */
    private function getCategories(): array
    {
        $option = $this->option('category');

        if (is_string($option)) {
            return [$option];
        }

        return ['men', 'women'];
    }
}
