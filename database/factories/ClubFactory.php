<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Club;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Club> */
final class ClubFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->company().' Climbing',
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'zipcode' => fake()->postcode(),
            'country_id' => Country::factory(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'creation_date' => fake()->optional()->date(),
        ];
    }
}
