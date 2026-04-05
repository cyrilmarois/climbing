<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Color;
use App\Models\Grade;
use App\Models\Route;
use App\Models\RouteComment;
use App\Models\RouteRecord;
use App\Models\Tag;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

final class RouteSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::all();
        $tags = Tag::all();
        $profiles = UserProfile::all();
        $grades = Grade::all();
        $colors = Color::all();

        foreach ($clubs as $club) {
            $routes = Route::factory(random_int(5, 15))->create([
                'club_id' => $club->id,
                'grade_id' => $grades->random()->id,
                'color_id' => $colors->random()->id,
            ]);

            foreach ($routes as $route) {
                // Attach 1-3 tags
                $route->tags()->attach(
                    $tags->random(random_int(1, 3))->pluck('id')->toArray()
                );

                // 0-5 route records from users
                $recordCount = random_int(0, 5);
                if ($recordCount > 0) {
                    $selectedProfiles = $profiles->random(min($recordCount, $profiles->count()));

                    foreach ($selectedProfiles as $profile) {
                        RouteRecord::factory()->create([
                            'route_id' => $route->id,
                            'user_profile_id' => $profile->id,
                        ]);
                    }
                }

                // 0-3 comments
                $commentCount = random_int(0, 3);
                if ($commentCount > 0) {
                    $commenters = $profiles->random(min($commentCount, $profiles->count()));

                    foreach ($commenters as $commenter) {
                        $comment = RouteComment::factory()->create([
                            'route_id' => $route->id,
                            'user_profile_id' => $commenter->id,
                        ]);

                        // 50% chance of a reply
                        if (random_int(0, 1)) {
                            RouteComment::factory()->reply($comment)->create([
                                'user_profile_id' => $profiles->random()->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
