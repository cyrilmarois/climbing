<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Event;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateEventRecordRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => ['sometimes', 'integer', Rule::exists(Event::class, 'id')],
            'user_profile_id' => ['sometimes', 'integer', Rule::exists(UserProfile::class, 'id')],
            'rank' => ['sometimes', 'integer', 'min:0'],
            'score' => ['sometimes', 'numeric'],
            'registered_at' => ['nullable', 'date'],
        ];
    }
}
