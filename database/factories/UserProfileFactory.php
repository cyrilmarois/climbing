<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\AvatarType;
use App\Models\Country;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<UserProfile> */
final class UserProfileFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'birth_date' => fake()->dateTimeBetween('-50 years', '-16 years'),
            'height' => fake()->randomFloat(2, 150, 200),
            'weight' => fake()->randomFloat(2, 45, 110),
            'description' => fake()->optional()->sentence(),
            'avatar_type' => AvatarType::Default,
            'country_id' => Country::factory(),
        ];
    }

    public function withoutCountry(): self
    {
        return $this->state(fn (): array => [
            'country_id' => null,
        ]);
    }
}
