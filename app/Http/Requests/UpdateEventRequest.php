<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Discipline;
use App\Models\Club;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateEventRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:200'],
            'type' => ['nullable', 'string', 'max:50'],
            'division' => ['nullable', 'string', 'max:50'],
            'discipline' => ['sometimes', Rule::enum(Discipline::class)],
            'date' => ['sometimes', 'date'],
            'city' => ['nullable', 'string', 'max:100'],
            'country_id' => ['sometimes', 'integer', Rule::exists(Country::class, 'id')],
            'club_id' => ['sometimes', 'integer', Rule::exists(Club::class, 'id')],
        ];
    }
}
