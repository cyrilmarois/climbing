<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    public function run(): void
    {
        $france = Country::where('code', 'FR')->first();

        // Admin / dev user
        $admin = User::factory()->create([
            'email' => 'admin@climbing.test',
        ]);

        UserProfile::factory()->create([
            'user_id' => $admin->id,
            'firstname' => 'Admin',
            'lastname' => 'User',
            'country_id' => $france?->id,
        ]);

        // Regular users with profiles
        $countryIds = Country::pluck('id');

        User::factory(10)
            ->create()
            ->each(function (User $user) use ($countryIds): void {
                UserProfile::factory()->create([
                    'user_id' => $user->id,
                    'country_id' => $countryIds->random(),
                ]);
            });
    }
}
