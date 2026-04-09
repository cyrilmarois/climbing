<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreCountryRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique(Country::class)],
            'code' => ['required', 'string', 'size:2', Rule::unique(Country::class)],
        ];
    }
}
