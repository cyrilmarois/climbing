<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Athlete;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreAthleteRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ifsc_id' => ['nullable', 'integer', Rule::unique(Athlete::class)],
            'firstname' => ['required', 'string', 'max:100'],
            'lastname' => ['required', 'string', 'max:100'],
            'country_id' => ['required', 'integer', Rule::exists(Country::class, 'id')],
            'birthday' => ['nullable', 'date'],
            'height' => ['nullable', 'integer', 'min:0'],
            'federation_id' => ['nullable', 'integer'],
            'photo_url' => ['nullable', 'string', 'max:500'],
        ];
    }
}
