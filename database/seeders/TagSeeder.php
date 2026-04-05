<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ClimbingTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

final class TagSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ClimbingTag::cases() as $tag) {
            Tag::firstOrCreate(['name' => $tag->value]);
        }
    }
}
