<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\AthleteFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read int $ifsc_id
 * @property-read string $firstname
 * @property-read string $lastname
 * @property-read int|null $country_id
 * @property-read CarbonInterface|null $birthday
 * @property-read int|null $height
 * @property-read int|null $federation_id
 * @property-read string|null $photo_url
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Country|null $country
 * @property-read Collection<int, AthleteRanking> $rankings
 */
final class Athlete extends Model
{
    /** @use HasFactory<AthleteFactory> */
    use HasFactory;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function rankings(): HasMany
    {
        return $this->hasMany(AthleteRanking::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'ifsc_id' => 'integer',
            'country_id' => 'integer',
            'birthday' => 'date',
            'height' => 'integer',
            'federation_id' => 'integer',
        ];
    }
}
