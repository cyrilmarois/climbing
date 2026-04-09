<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Event;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreEventRecordRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'integer', Rule::exists(Event::class, 'id')],
            'user_profile_id' => ['required', 'integer', Rule::exists(UserProfile::class, 'id')],
            'rank' => ['required', 'integer', 'min:0'],
            'score' => ['required', 'numeric'],
            'registered_at' => ['nullable', 'date'],
        ];
    }
}
