<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventRecord;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<EventRecord> */
final class EventRecordFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'user_profile_id' => UserProfile::factory(),
            'ranking' => fake()->optional()->numberBetween(1, 100),
            'score' => fake()->optional()->randomFloat(2, 0, 100),
        ];
    }
}
