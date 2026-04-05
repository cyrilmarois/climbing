<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            TagSeeder::class,
            GradeSeeder::class,
            ColorSeeder::class,
            UserSeeder::class,
            ClubSeeder::class,
            RouteSeeder::class,
            EventSeeder::class,
        ]);
    }
}
