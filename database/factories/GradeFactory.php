<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\GradeSystem;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Grade> */
final class GradeFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['4a', '4b', '4c', '5a', '5b', '5c', '6a', '6a+', '6b', '6b+', '6c', '6c+', '7a', '7a+', '7b', '7b+', '7c', '7c+', '8a', '8a+']),
            'system' => GradeSystem::French,
            'sort_order' => fake()->unique()->numberBetween(1, 100),
        ];
    }

    public function yosemite(): self
    {
        return $this->state(fn (): array => [
            'name' => fake()->unique()->randomElement(['5.6', '5.7', '5.8', '5.9', '5.10a', '5.10b', '5.10c', '5.10d', '5.11a', '5.11b', '5.11c', '5.11d', '5.12a', '5.12b']),
            'system' => GradeSystem::Yosemite,
        ]);
    }

    public function uiaa(): self
    {
        return $this->state(fn (): array => [
            'name' => fake()->unique()->randomElement(['IV', 'IV+', 'V-', 'V', 'V+', 'VI-', 'VI', 'VI+', 'VII-', 'VII', 'VII+', 'VIII-', 'VIII']),
            'system' => GradeSystem::UIAA,
        ]);
    }
}
