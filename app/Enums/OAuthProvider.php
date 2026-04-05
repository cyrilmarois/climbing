<?php

declare(strict_types=1);

namespace App\Enums;

enum OAuthProvider: string
{
    case Google = 'google';
    case GitHub = 'github';
    case Facebook = 'facebook';
    case Twitter = 'twitter';
    case Apple = 'apple';
}
