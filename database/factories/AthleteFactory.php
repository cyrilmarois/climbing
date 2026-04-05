<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Athlete> */
final class AthleteFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'ifsc_id' => fake()->unique()->numberBetween(1, 99999),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'country_id' => Country::factory(),
            'birthday' => fake()->optional()->dateTimeBetween('-40 years', '-16 years'),
            'height' => fake()->optional()->numberBetween(150, 200),
            'federation_id' => fake()->numberBetween(1, 60),
            'photo_url' => null,
        ];
    }
}
