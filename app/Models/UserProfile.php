<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AvatarType;
use Carbon\CarbonInterface;
use Database\Factories\UserProfileFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read string|null $firstname
 * @property-read string|null $lastname
 * @property-read string|null $gender
 * @property-read CarbonInterface|null $birth_date
 * @property-read float|null $height
 * @property-read float|null $weight
 * @property-read string|null $description
 * @property-read AvatarType $avatar_type
 * @property-read string|null $avatar_url
 * @property-read string|null $avatar_path
 * @property-read int|null $country_id
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read User $user
 * @property-read Country|null $country
 * @property-read Collection<int, Club> $clubs
 * @property-read Collection<int, RouteRecord> $routeRecords
 * @property-read Collection<int, EventRecord> $eventRecords
 * @property-read Collection<int, RouteComment> $routeComments
 */
final class UserProfile extends Model
{
    /** @use HasFactory<UserProfileFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function clubs(): BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'user_clubs')
            ->withPivot('registered_at')
            ->withTimestamps();
    }

    public function routeRecords(): HasMany
    {
        return $this->hasMany(RouteRecord::class);
    }

    public function eventRecords(): HasMany
    {
        return $this->hasMany(EventRecord::class);
    }

    public function routeComments(): HasMany
    {
        return $this->hasMany(RouteComment::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'birth_date' => 'date',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
            'avatar_type' => AvatarType::class,
            'country_id' => 'integer',
        ];
    }
}
