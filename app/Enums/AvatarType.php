<?php

declare(strict_types=1);

namespace App\Enums;

enum AvatarType: string
{
    case Social = 'social';
    case Upload = 'upload';
    case Default = 'default';
}
