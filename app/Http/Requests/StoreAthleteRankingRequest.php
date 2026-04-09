<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Athlete;
use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreAthleteRankingRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'athlete_id' => ['required', 'integer', Rule::exists(Athlete::class, 'id')],
            'event_id' => ['required', 'integer', Rule::exists(Event::class, 'id')],
            'rank' => ['required', 'integer', 'min:0'],
            'score' => ['required', 'numeric'],
        ];
    }
}
