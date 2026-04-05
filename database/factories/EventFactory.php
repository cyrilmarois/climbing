<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Discipline;
use App\Models\Country;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Event> */
final class EventFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'type' => fake()->optional()->randomElement(['competition', 'exhibition', 'workshop']),
            'division' => fake()->optional()->randomElement(['open', 'national', 'regional']),
            'discipline' => fake()->randomElement(Discipline::cases()),
            'date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'city' => fake()->optional()->city(),
            'country_id' => Country::factory(),
            'club_id' => null,
        ];
    }
}
