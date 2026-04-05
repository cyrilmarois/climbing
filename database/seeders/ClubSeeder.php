<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Country;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class ClubSeeder extends Seeder
{
    public function run(): void
    {
        $france = Country::where('code', 'FR')->first();

        $clubs = [
            ['name' => 'Arkose Nation', 'city' => 'Paris', 'zipcode' => '75013', 'country_id' => $france?->id, 'latitude' => 48.8322, 'longitude' => 2.3561],
            ['name' => 'Climb Up Aubervilliers', 'city' => 'Aubervilliers', 'zipcode' => '93300', 'country_id' => $france?->id, 'latitude' => 48.9145, 'longitude' => 2.3826],
            ['name' => 'Block Out', 'city' => 'Lyon', 'zipcode' => '69003', 'country_id' => $france?->id, 'latitude' => 45.7578, 'longitude' => 4.8320],
        ];

        foreach ($clubs as $clubData) {
            Club::firstOrCreate(['name' => $clubData['name']], $clubData);
        }

        // Additional clubs
        Club::factory(5)->create();

        // Assign users to clubs
        $profiles = UserProfile::all();
        $allClubs = Club::all();

        foreach ($profiles as $profile) {
            $clubsToJoin = $allClubs->random(random_int(1, 2));

            foreach ($clubsToJoin as $club) {
                DB::table('user_clubs')->insertOrIgnore([
                    'user_profile_id' => $profile->id,
                    'club_id' => $club->id,
                    'registered_at' => now()->subDays(random_int(1, 365)),
                    'created_at' => now(),
                ]);
            }
        }
    }
}
