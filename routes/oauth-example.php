<?php

declare(strict_types=1);

// Ajoutez ces routes à web.php :

use App\Http\Controllers\Auth\SocialAuthController;

// OAuth routes
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->name('social.redirect')
    ->where('provider', 'google|github|facebook|twitter|apple');

Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->name('social.callback')
    ->where('provider', 'google|github|facebook|twitter|apple');
