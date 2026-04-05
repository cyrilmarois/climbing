<?php

declare(strict_types=1);

namespace App\Enums;

enum GradeName: string
{
    // French
    case French4a = '4a';
    case French4b = '4b';
    case French4c = '4c';
    case French5a = '5a';
    case French5b = '5b';
    case French5c = '5c';
    case French6a = '6a';
    case French6aPlus = '6a+';
    case French6b = '6b';
    case French6bPlus = '6b+';
    case French6c = '6c';
    case French6cPlus = '6c+';
    case French7a = '7a';
    case French7aPlus = '7a+';
    case French7b = '7b';
    case French7bPlus = '7b+';
    case French7c = '7c';
    case French7cPlus = '7c+';
    case French8a = '8a';
    case French8aPlus = '8a+';

    // Yosemite
    case Yosemite56 = '5.6';
    case Yosemite57 = '5.7';
    case Yosemite58 = '5.8';
    case Yosemite59 = '5.9';
    case Yosemite510a = '5.10a';
    case Yosemite510b = '5.10b';
    case Yosemite510c = '5.10c';
    case Yosemite510d = '5.10d';
    case Yosemite511a = '5.11a';
    case Yosemite511b = '5.11b';
    case Yosemite511c = '5.11c';
    case Yosemite511d = '5.11d';
    case Yosemite512a = '5.12a';
    case Yosemite512b = '5.12b';

    // UIAA
    case UiaaIV = 'IV';
    case UiaaIVPlus = 'IV+';
    case UiaaVMinus = 'V-';
    case UiaaV = 'V';
    case UiaaVPlus = 'V+';
    case UiaaVIMinus = 'VI-';
    case UiaaVI = 'VI';
    case UiaaVIPlus = 'VI+';
    case UiaaVIIMinus = 'VII-';
    case UiaaVII = 'VII';
    case UiaaVIIPlus = 'VII+';
    case UiaaVIIIMinus = 'VIII-';
    case UiaaVIII = 'VIII';

    /** @return list<self> */
    public static function forSystem(GradeSystem $system): array
    {
        return match ($system) {
            GradeSystem::French => [
                self::French4a, self::French4b, self::French4c,
                self::French5a, self::French5b, self::French5c,
                self::French6a, self::French6aPlus, self::French6b, self::French6bPlus, self::French6c, self::French6cPlus,
                self::French7a, self::French7aPlus, self::French7b, self::French7bPlus, self::French7c, self::French7cPlus,
                self::French8a, self::French8aPlus,
            ],
            GradeSystem::Yosemite => [
                self::Yosemite56, self::Yosemite57, self::Yosemite58, self::Yosemite59,
                self::Yosemite510a, self::Yosemite510b, self::Yosemite510c, self::Yosemite510d,
                self::Yosemite511a, self::Yosemite511b, self::Yosemite511c, self::Yosemite511d,
                self::Yosemite512a, self::Yosemite512b,
            ],
            GradeSystem::UIAA => [
                self::UiaaIV, self::UiaaIVPlus,
                self::UiaaVMinus, self::UiaaV, self::UiaaVPlus,
                self::UiaaVIMinus, self::UiaaVI, self::UiaaVIPlus,
                self::UiaaVIIMinus, self::UiaaVII, self::UiaaVIIPlus,
                self::UiaaVIIIMinus, self::UiaaVIII,
            ],
        };
    }
}
