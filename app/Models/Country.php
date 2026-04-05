<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $code
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Collection<int, Club> $clubs
 * @property-read Collection<int, UserProfile> $userProfiles
 * @property-read Collection<int, Event> $events
 */
final class Country extends Model
{
    /** @use HasFactory<CountryFactory> */
    use HasFactory;

    public function clubs(): HasMany
    {
        return $this->hasMany(Club::class);
    }

    public function userProfiles(): HasMany
    {
        return $this->hasMany(UserProfile::class);
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
            'code' => 'string',
        ];
    }
}
