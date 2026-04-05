<?php

declare(strict_types=1);

namespace App\Enums;

enum ClimbingTag: string
{
    // Par style/discipline
    case Slab = 'slab';
    case Overhang = 'overhang';
    case Vertical = 'vertical';
    case Compression = 'compression';

    // Par types de prises
    case Crimps = 'crimps';
    case Jugs = 'jugs';
    case Pockets = 'pockets';
    case Slopers = 'slopers';
    case Pinches = 'pinches';

    // Par caractéristiques de difficulté
    case Technical = 'technical';
    case Powerful = 'powerful';
    case Endurance = 'endurance';
    case Pumpy = 'pumpy';
    case Balance = 'balance';

    // Par type de mouvement
    case Mantel = 'mantel';
    case Dyno = 'dyno';
    case Traverse = 'traverse';
    case Crux = 'crux';

    // Par sensation
    case Soft = 'soft';
    case Stiff = 'stiff';
    case Crimpy = 'crimpy';
    case Jugy = 'jugy';
    case Scary = 'scary';

    public static function allNames(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }

    public static function allLabels(): array
    {
        return array_combine(
            self::allNames(),
            array_map(fn (self $case) => ucfirst($case->value), self::cases())
        );
    }
}
