<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateCountryRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Country $country */
        $country = $this->route('country');

        return [
            'name' => ['sometimes', 'string', 'max:100', Rule::unique(Country::class)->ignore($country->id)],
            'code' => ['sometimes', 'string', 'size:2', Rule::unique(Country::class)->ignore($country->id)],
        ];
    }
}
