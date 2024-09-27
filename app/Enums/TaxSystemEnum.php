<?php

namespace App\Enums;

enum TaxSystemEnum: string
{
    case USN_SIX_PERСENT = 'УСН 6%';
    case USN_TEN_PERCENT_DIFFERENCE = 'УСН (доходы минус расходы 10%)';
    case USN_FIFTEEN_PERCENT_DIFFERENCE = 'УСН (доходы минус расходы 15%)';
    case OSNO = 'ОСНО';
    case PATENT = 'Патент';
    case UNIFIED_AGRICULTURAL_TAX = 'ЕСХН';
    case SELF_EMPLOYED = 'Самозанятый';

    public static function getValues()
    {
        return [
            self::USN_SIX_PERСENT->value,
            self::USN_TEN_PERCENT_DIFFERENCE->value,
            self::USN_FIFTEEN_PERCENT_DIFFERENCE->value,
            self::OSNO->value,
            self::PATENT->value,
            self::SELF_EMPLOYED->value,
            self::UNIFIED_AGRICULTURAL_TAX->value,
        ];
    }
}
