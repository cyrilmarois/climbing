<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Discipline;
use App\Models\Club;
use App\Models\Color;
use App\Models\Grade;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Route> */
final class RouteFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'club_id' => Club::factory(),
            'grade_id' => Grade::factory(),
            'color_id' => Color::factory(),
            'line' => fake()->optional()->randomElement(['A', 'B', 'C', 'D', 'E']),
            'order' => fake()->numberBetween(1, 20),
            'discipline' => fake()->randomElement(Discipline::cases()),
            'description' => fake()->optional()->sentence(),
            'opening_date' => fake()->optional()->date(),
            'closing_date' => null,
            'is_active' => null,
        ];
    }

    public function bloc(): self
    {
        return $this->state(fn(): array => [
            'type' => Discipline::Bloc,
        ]);
    }

    public function lead(): self
    {
        return $this->state(fn(): array => [
            'type' => Discipline::Lead,
        ]);
    }

    public function speed(): self
    {
        return $this->state(fn(): array => [
            'type' => Discipline::Speed,
        ]);
    }
}
