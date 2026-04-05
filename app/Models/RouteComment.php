<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\RouteCommentFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read int $route_id
 * @property-read int $user_profile_id
 * @property-read string $text
 * @property-read int|null $parent_id
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Route $route
 * @property-read UserProfile $userProfile
 * @property-read RouteComment|null $parent
 * @property-read Collection<int, RouteComment> $replies
 */
final class RouteComment extends Model
{
    /** @use HasFactory<RouteCommentFactory> */
    use HasFactory;

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'route_id' => 'integer',
            'user_profile_id' => 'integer',
            'parent_id' => 'integer',
        ];
    }
}
