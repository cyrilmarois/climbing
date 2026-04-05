<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Discipline;
use Carbon\CarbonInterface;
use Database\Factories\RouteFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read int $club_id
 * @property-read int|null $grade_id
 * @property-read int|null $color_id
 * @property-read string|null $line
 * @property-read int $order
 * @property-read Discipline|null $discipline
 * @property-read string|null $description
 * @property-read CarbonInterface|null $opening_date
 * @property-read CarbonInterface|null $closing_date
 * @property-read CarbonInterface|null $is_active
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Club $club
 * @property-read Grade|null $grade
 * @property-read Color|null $color
 * @property-read Collection<int, Tag> $tags
 * @property-read Collection<int, RouteRecord> $records
 * @property-read Collection<int, RouteComment> $comments
 */
final class Route extends Model
{
    /** @use HasFactory<RouteFactory> */
    use HasFactory;

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'route_tags');
    }

    public function records(): HasMany
    {
        return $this->hasMany(RouteRecord::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(RouteComment::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'club_id' => 'integer',
            'grade_id' => 'integer',
            'color_id' => 'integer',
            'order' => 'integer',
            'discipline' => Discipline::class,
            'opening_date' => 'date',
            'closing_date' => 'date',
            'is_active' => 'date',
        ];
    }
}
