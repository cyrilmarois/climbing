<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\GradeSystem;
use Carbon\CarbonInterface;
use Database\Factories\GradeFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read GradeSystem $system
 * @property-read int $sort_order
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Collection<int, Route> $routes
 * @property-read Collection<int, RouteRecord> $routeRecords
 */
final class Grade extends Model
{
    /** @use HasFactory<GradeFactory> */
    use HasFactory;

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }

    public function routeRecords(): HasMany
    {
        return $this->hasMany(RouteRecord::class, 'custom_grade_id');
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'system' => GradeSystem::class,
            'sort_order' => 'integer',
        ];
    }
}
