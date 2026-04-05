<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Maps IOC 3-letter country codes (used by IFSC) to ISO 3166-1 alpha-2 codes.
 */
enum IocCountryCode: string
{
    case AFG = 'AF';
    case ALB = 'AL';
    case ALG = 'DZ';
    case AND = 'AD';
    case ANG = 'AO';
    case ANT = 'AG';
    case ARG = 'AR';
    case ARM = 'AM';
    case AUS = 'AU';
    case AUT = 'AT';
    case AZE = 'AZ';
    case BAH = 'BS';
    case BAN = 'BD';
    case BAR = 'BB';
    case BEL = 'BE';
    case BEN = 'BJ';
    case BER = 'BM';
    case BHU = 'BT';
    case BIH = 'BA';
    case BLR = 'BY';
    case BOL = 'BO';
    case BOT = 'BW';
    case BRA = 'BR';
    case BRN = 'BH';
    case BRU = 'BN';
    case BUL = 'BG';
    case BUR = 'BF';
    case CAM = 'KH';
    case CAN = 'CA';
    case CHI = 'CL';
    case CHN = 'CN';
    case CIV = 'CI';
    case CMR = 'CM';
    case COD = 'CD';
    case COL = 'CO';
    case CRC = 'CR';
    case CRO = 'HR';
    case CUB = 'CU';
    case CYP = 'CY';
    case CZE = 'CZ';
    case DEN = 'DK';
    case DOM = 'DO';
    case ECU = 'EC';
    case EGY = 'EG';
    case ESA = 'SV';
    case ESP = 'ES';
    case EST = 'EE';
    case ETH = 'ET';
    case FIN = 'FI';
    case FRA = 'FR';
    case GBR = 'GB';
    case GEO = 'GE';
    case GER = 'DE';
    case GHA = 'GH';
    case GRE = 'GR';
    case GUA = 'GT';
    case GUY = 'GY';
    case HAI = 'HT';
    case HKG = 'HK';
    case HON = 'HN';
    case HUN = 'HU';
    case INA = 'ID';
    case IND = 'IN';
    case IRI = 'IR';
    case IRL = 'IE';
    case IRQ = 'IQ';
    case ISL = 'IS';
    case ISR = 'IL';
    case ITA = 'IT';
    case JAM = 'JM';
    case JOR = 'JO';
    case JPN = 'JP';
    case KAZ = 'KZ';
    case KEN = 'KE';
    case KGZ = 'KG';
    case KOR = 'KR';
    case KSA = 'SA';
    case KUW = 'KW';
    case LAO = 'LA';
    case LAT = 'LV';
    case LBN = 'LB';
    case LIE = 'LI';
    case LTU = 'LT';
    case LUX = 'LU';
    case MAD = 'MG';
    case MAS = 'MY';
    case MAR = 'MA';
    case MDA = 'MD';
    case MEX = 'MX';
    case MGL = 'MN';
    case MKD = 'MK';
    case MLI = 'ML';
    case MLT = 'MT';
    case MNE = 'ME';
    case MON = 'MC';
    case MOZ = 'MZ';
    case MRI = 'MU';
    case MYA = 'MM';
    case NAM = 'NA';
    case NED = 'NL';
    case NEP = 'NP';
    case NGR = 'NG';
    case NCA = 'NI';
    case NOR = 'NO';
    case NZL = 'NZ';
    case OMA = 'OM';
    case PAK = 'PK';
    case PAN = 'PA';
    case PAR = 'PY';
    case PER = 'PE';
    case PHI = 'PH';
    case POL = 'PL';
    case POR = 'PT';
    case PRK = 'KP';
    case PUR = 'PR';
    case QAT = 'QA';
    case ROU = 'RO';
    case RSA = 'ZA';
    case RUS = 'RU';
    case RWA = 'RW';
    case SEN = 'SN';
    case SGP = 'SG';
    case SLO = 'SI';
    case SRB = 'RS';
    case SRI = 'LK';
    case SUD = 'SD';
    case SUI = 'CH';
    case SVK = 'SK';
    case SWE = 'SE';
    case SYR = 'SY';
    case THA = 'TH';
    case TJK = 'TJ';
    case TKM = 'TM';
    case TPE = 'TW';
    case TTO = 'TT';
    case TUN = 'TN';
    case TUR = 'TR';
    case UAE = 'AE';
    case UGA = 'UG';
    case UKR = 'UA';
    case URU = 'UY';
    case USA = 'US';
    case UZB = 'UZ';
    case VEN = 'VE';
    case VIE = 'VN';
    case ZAM = 'ZM';
    case ZIM = 'ZW';

    public static function toIso2(string $iocCode): ?string
    {
        $normalized = mb_strtoupper($iocCode);

        foreach (self::cases() as $case) {
            if ($case->name === $normalized) {
                return $case->value;
            }
        }

        return null;
    }
}
