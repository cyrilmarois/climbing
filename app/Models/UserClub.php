<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property-read int $id
 * @property-read int $user_profile_id
 * @property-read int $club_id
 * @property-read CarbonInterface $registered_at
 * @property-read CarbonInterface $created_at
 * @property-read UserProfile $userProfile
 * @property-read Club $club
 */
final class UserClub extends Pivot
{
    public $incrementing = true;

    protected $table = 'user_clubs';

    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'user_profile_id' => 'integer',
            'club_id' => 'integer',
            'registered_at' => 'date',
        ];
    }
}
