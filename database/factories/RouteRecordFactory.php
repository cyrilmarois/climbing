<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Route;
use App\Models\RouteRecord;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RouteRecord> */
final class RouteRecordFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'route_id' => Route::factory(),
            'user_profile_id' => UserProfile::factory(),
            'custom_grade_id' => null,
            'tries' => fake()->optional()->numberBetween(1, 20),
            'rating' => fake()->optional()->numberBetween(1, 5),
        ];
    }
}
