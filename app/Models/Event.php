<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Discipline;
use Carbon\CarbonInterface;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $title
 * @property-read string|null $type
 * @property-read string|null $division
 * @property-read Discipline|null $discipline
 * @property-read CarbonInterface $date
 * @property-read string|null $city
 * @property-read int|null $country_id
 * @property-read int|null $club_id
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Country|null $country
 * @property-read Club|null $club
 * @property-read Collection<int, EventRecord> $records
 */
final class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function records(): HasMany
    {
        return $this->hasMany(EventRecord::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'discipline' => Discipline::class,
            'date' => 'date',
            'country_id' => 'integer',
            'club_id' => 'integer',
        ];
    }
}
