<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Athlete;
use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateAthleteRankingRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'athlete_id' => ['sometimes', 'integer', Rule::exists(Athlete::class, 'id')],
            'event_id' => ['sometimes', 'integer', Rule::exists(Event::class, 'id')],
            'rank' => ['sometimes', 'integer', 'min:0'],
            'score' => ['sometimes', 'numeric'],
        ];
    }
}
