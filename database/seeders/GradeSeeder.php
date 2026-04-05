<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\GradeSystem;
use App\Models\Grade;
use Illuminate\Database\Seeder;

final class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $frenchGrades = ['4a', '4b', '4c', '5a', '5b', '5c', '6a', '6a+', '6b', '6b+', '6c', '6c+', '7a', '7a+', '7b', '7b+', '7c', '7c+', '8a', '8a+', '8b', '8b+', '8c', '8c+', '9a', '9a+'];
        $yosemiteGrades = ['5.6', '5.7', '5.8', '5.9', '5.10a', '5.10b', '5.10c', '5.10d', '5.11a', '5.11b', '5.11c', '5.11d', '5.12a', '5.12b', '5.12c', '5.12d', '5.13a', '5.13b', '5.13c', '5.13d', '5.14a', '5.14b'];
        $uiaaGrades = ['IV', 'IV+', 'V-', 'V', 'V+', 'VI-', 'VI', 'VI+', 'VII-', 'VII', 'VII+', 'VIII-', 'VIII', 'VIII+', 'IX-', 'IX', 'IX+', 'X-', 'X', 'X+', 'XI-', 'XI'];

        $this->seedGrades($frenchGrades, GradeSystem::French);
        $this->seedGrades($yosemiteGrades, GradeSystem::Yosemite);
        $this->seedGrades($uiaaGrades, GradeSystem::UIAA);
    }

    /**
     * @param  array<int, string>  $grades
     */
    private function seedGrades(array $grades, GradeSystem $system): void
    {
        foreach ($grades as $index => $name) {
            Grade::firstOrCreate(
                ['name' => $name, 'system' => $system],
                ['sort_order' => $index + 1],
            );
        }
    }
}
