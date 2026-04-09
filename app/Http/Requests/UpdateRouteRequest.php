<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Discipline;
use App\Models\Club;
use App\Models\Color;
use App\Models\Grade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRouteRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:150'],
            'club_id' => ['sometimes', 'integer', Rule::exists(Club::class, 'id')],
            'grade_id' => ['nullable', 'integer', Rule::exists(Grade::class, 'id')],
            'color_id' => ['nullable', 'integer', Rule::exists(Color::class, 'id')],
            'line' => ['nullable', 'string', 'max:50'],
            'order' => ['sometimes', 'integer', 'min:0'],
            'discipline' => ['nullable', Rule::enum(Discipline::class)],
            'description' => ['nullable', 'string'],
            'opening_date' => ['nullable', 'date'],
            'closing_date' => ['nullable', 'date', 'after_or_equal:opening_date'],
            'is_active' => ['nullable', 'date'],
        ];
    }
}
