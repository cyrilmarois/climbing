<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Event;
use App\Models\EventRecord;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

final class EventSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::all();
        $profiles = UserProfile::all();

        // Events linked to clubs
        foreach ($clubs->random(min(3, $clubs->count())) as $club) {
            $events = Event::factory(random_int(1, 3))->create([
                'club_id' => $club->id,
                'country_id' => $club->country_id,
                'city' => $club->city,
            ]);

            foreach ($events as $event) {
                $participantCount = random_int(2, min(6, $profiles->count()));
                $participants = $profiles->random($participantCount);

                foreach ($participants as $index => $profile) {
                    EventRecord::factory()->create([
                        'event_id' => $event->id,
                        'user_profile_id' => $profile->id,
                        'rank' => $index + 1,
                    ]);
                }
            }
        }

        // Standalone events
        $countryIds = \App\Models\Country::pluck('id');
        Event::factory(3)->create([
            'country_id' => fn () => $countryIds->random(),
        ])->each(function (Event $event) use ($profiles): void {
            $participantCount = random_int(2, min(5, $profiles->count()));
            $participants = $profiles->random($participantCount);

            foreach ($participants as $index => $profile) {
                EventRecord::factory()->create([
                    'event_id' => $event->id,
                    'user_profile_id' => $profile->id,
                    'rank' => $index + 1,
                ]);
            }
        });
    }
}
