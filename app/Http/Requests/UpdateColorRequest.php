<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Color;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateColorRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Color $color */
        $color = $this->route('color');

        return [
            'name' => ['required', 'string', 'max:50', Rule::unique(Color::class)->ignore($color->id)],
        ];
    }
}
