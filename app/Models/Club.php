<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\ClubFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string|null $address
 * @property-read string|null $city
 * @property-read string|null $zipcode
 * @property-read int $country_id
 * @property-read float|null $latitude
 * @property-read float|null $longitude
 * @property-read CarbonInterface|null $creation_date
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Country $country
 * @property-read Collection<int, UserProfile> $userProfiles
 * @property-read Collection<int, Route> $routes
 * @property-read Collection<int, Event> $events
 */
final class Club extends Model
{
    /** @use HasFactory<ClubFactory> */
    use HasFactory;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function userProfiles(): BelongsToMany
    {
        return $this->belongsToMany(UserProfile::class, 'user_clubs')
            ->withPivot('registered_at')
            ->withTimestamps();
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'country_id' => 'integer',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'creation_date' => 'date',
        ];
    }
}
