<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\RouteRecordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $route_id
 * @property-read int $user_profile_id
 * @property-read int|null $custom_grade_id
 * @property-read int|null $tries
 * @property-read int|null $rating
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Route $route
 * @property-read UserProfile $userProfile
 * @property-read Grade|null $customGrade
 */
final class RouteRecord extends Model
{
    /** @use HasFactory<RouteRecordFactory> */
    use HasFactory;

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function customGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'custom_grade_id');
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'route_id' => 'integer',
            'user_profile_id' => 'integer',
            'custom_grade_id' => 'integer',
            'tries' => 'integer',
            'rating' => 'integer',
        ];
    }
}
