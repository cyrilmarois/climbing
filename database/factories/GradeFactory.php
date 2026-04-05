<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\GradeName;
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
            'name' => fake()->unique()->randomElement(GradeName::forSystem(GradeSystem::French)),
            'system' => GradeSystem::French,
            'sort_order' => fake()->unique()->numberBetween(1, 100),
        ];
    }

    public function yosemite(): self
    {
        return $this->state(fn (): array => [
            'name' => fake()->unique()->randomElement(GradeName::forSystem(GradeSystem::Yosemite)),
            'system' => GradeSystem::Yosemite,
        ]);
    }

    public function uiaa(): self
    {
        return $this->state(fn (): array => [
            'name' => fake()->unique()->randomElement(GradeName::forSystem(GradeSystem::UIAA)),
            'system' => GradeSystem::UIAA,
        ]);
    }
}
