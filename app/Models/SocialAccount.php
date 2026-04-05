<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OAuthProvider;
use Carbon\CarbonInterface;
use Database\Factories\SocialAccountFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read OAuthProvider $provider
 * @property-read string $provider_id
 * @property-read string|null $email
 * @property-read string|null $name
 * @property-read string|null $access_token
 * @property-read string|null $refresh_token
 * @property-read CarbonInterface|null $token_expires_at
 * @property-read array<string, mixed>|null $profile_data
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read User $user
 */
final class SocialAccount extends Model
{
    /** @use HasFactory<SocialAccountFactory> */
    use HasFactory;

    protected $hidden = [
        'access_token',
        'refresh_token',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->token_expires_at !== null && $this->token_expires_at->isPast();
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'provider' => OAuthProvider::class,
            'token_expires_at' => 'datetime',
            'profile_data' => 'json',
        ];
    }
}
