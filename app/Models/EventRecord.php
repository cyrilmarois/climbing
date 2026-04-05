<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\EventRecordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $event_id
 * @property-read int $user_profile_id
 * @property-read int|null $rank
 * @property-read float|null $score
 * @property-read CarbonInterface $registered_at
 * @property-read Event $event
 * @property-read UserProfile $userProfile
 */
final class EventRecord extends Model
{
    /** @use HasFactory<EventRecordFactory> */
    use HasFactory;

    public $timestamps = false;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'event_id' => 'integer',
            'user_profile_id' => 'integer',
            'rank' => 'integer',
            'score' => 'decimal:2',
            'registered_at' => 'datetime',
        ];
    }
}
