<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

final class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Japan', 'code' => 'JP'],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(['code' => $country['code']], $country);
        }
    }
}
