<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Route;
use App\Models\RouteComment;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRouteCommentRequest extends FormRequest
{
    /**
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'route_id' => ['required', 'integer', Rule::exists(Route::class, 'id')],
            'user_profile_id' => ['required', 'integer', Rule::exists(UserProfile::class, 'id')],
            'text' => ['required', 'string'],
            'parent_id' => ['nullable', 'integer', Rule::exists(RouteComment::class, 'id')],
        ];
    }
}
