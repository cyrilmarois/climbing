<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Color> */
final class ColorFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->safeColorName(),
        ];
    }
}
