<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\GradeSystem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreGradeRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'system' => ['required', Rule::enum(GradeSystem::class)],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }
}
