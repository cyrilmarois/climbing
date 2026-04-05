<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\AthleteRankingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $athlete_id
 * @property-read int $event_id
 * @property-read int|null $rank
 * @property-read float|null $score
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Athlete $athlete
 * @property-read Event $event
 */
final class AthleteRanking extends Model
{
    /** @use HasFactory<AthleteRankingFactory> */
    use HasFactory;

    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'athlete_id' => 'integer',
            'event_id' => 'integer',
            'rank' => 'integer',
            'score' => 'decimal:2',
        ];
    }
}
