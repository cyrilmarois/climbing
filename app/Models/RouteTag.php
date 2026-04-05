<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property-read int $route_id
 * @property-read int $tag_id
 * @property-read Route $route
 * @property-read Tag $tag
 */
final class RouteTag extends Pivot
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'route_tags';

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'route_id' => 'integer',
            'tag_id' => 'integer',
        ];
    }
}
