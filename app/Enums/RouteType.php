<?php

declare(strict_types=1);

namespace App\Enums;

enum RouteType: string
{
    case Bloc = 'bloc';
    case Lead = 'lead';
    case Speed = 'speed';
}
