<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Discipline;
use App\Models\Club;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreEventRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'type' => ['nullable', 'string', 'max:50'],
            'division' => ['nullable', 'string', 'max:50'],
            'discipline' => ['required', Rule::enum(Discipline::class)],
            'date' => ['required', 'date'],
            'city' => ['nullable', 'string', 'max:100'],
            'country_id' => ['required', 'integer', Rule::exists(Country::class, 'id')],
            'club_id' => ['required', 'integer', Rule::exists(Club::class, 'id')],
        ];
    }
}
