<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\AthleteRanking;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<AthleteRanking> */
final class AthleteRankingFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'athlete_id' => Athlete::factory(),
            'event_id' => Event::factory(),
            'rank' => fake()->numberBetween(1, 100),
            'score' => fake()->randomFloat(2, 10, 2000),
        ];
    }
}
