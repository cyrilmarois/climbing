<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\OAuthProvider;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<SocialAccount> */
final class SocialAccountFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'provider' => fake()->randomElement(OAuthProvider::cases()),
            'provider_id' => fake()->unique()->uuid(),
            'email' => fake()->optional()->safeEmail(),
            'name' => fake()->optional()->name(),
            'access_token' => fake()->sha256(),
            'refresh_token' => fake()->optional()->sha256(),
            'token_expires_at' => fake()->optional()->dateTimeBetween('now', '+1 year'),
            'profile_data' => null,
        ];
    }
}
