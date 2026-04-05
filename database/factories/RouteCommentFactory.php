<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Route;
use App\Models\RouteComment;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RouteComment> */
final class RouteCommentFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'route_id' => Route::factory(),
            'user_profile_id' => UserProfile::factory(),
            'text' => fake()->paragraph(),
            'parent_id' => null,
        ];
    }

    public function reply(RouteComment $parent): self
    {
        return $this->state(fn (): array => [
            'route_id' => $parent->route_id,
            'parent_id' => $parent->id,
        ]);
    }
}
