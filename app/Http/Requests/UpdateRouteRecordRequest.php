<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Grade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRouteRecordRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'custom_grade_id' => ['nullable', 'integer', Rule::exists(Grade::class, 'id')],
            'tries' => ['sometimes', 'integer', 'min:0'],
            'rating' => ['nullable', 'integer', 'min:0', 'max:5'],
        ];
    }
}
