<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ColorName;
use App\Models\Color;
use Illuminate\Database\Seeder;

final class ColorSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ColorName::cases() as $color) {
            Color::firstOrCreate(['name' => $color->value]);
        }
    }
}
