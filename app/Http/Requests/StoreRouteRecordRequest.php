<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Grade;
use App\Models\Route;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRouteRecordRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'route_id' => ['required', 'integer', Rule::exists(Route::class, 'id')],
            'user_profile_id' => ['required', 'integer', Rule::exists(UserProfile::class, 'id')],
            'custom_grade_id' => ['nullable', 'integer', Rule::exists(Grade::class, 'id')],
            'tries' => ['required', 'integer', 'min:0'],
            'rating' => ['nullable', 'integer', 'min:0', 'max:5'],
        ];
    }
}
