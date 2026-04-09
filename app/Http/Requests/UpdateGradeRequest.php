<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\GradeSystem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateGradeRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:20'],
            'system' => ['sometimes', Rule::enum(GradeSystem::class)],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
