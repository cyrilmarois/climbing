<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Athlete;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateAthleteRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Athlete $athlete */
        $athlete = $this->route('athlete');

        return [
            'ifsc_id' => ['nullable', 'integer', Rule::unique(Athlete::class)->ignore($athlete->id)],
            'firstname' => ['sometimes', 'string', 'max:100'],
            'lastname' => ['sometimes', 'string', 'max:100'],
            'country_id' => ['sometimes', 'integer', Rule::exists(Country::class, 'id')],
            'birthday' => ['nullable', 'date'],
            'height' => ['nullable', 'integer', 'min:0'],
            'federation_id' => ['nullable', 'integer'],
            'photo_url' => ['nullable', 'string', 'max:500'],
        ];
    }
}
