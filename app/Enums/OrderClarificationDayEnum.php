<?php

namespace App\Enums;

enum OrderClarificationDayEnum: string
{
    case SATURDAY = 'Суббота';
    case SUNDAY = 'Воскресенье';
    case SATURDAY_AND_SUNDAY = 'Суббота и воскресенье';

    public static function getValue():array
    {
        return [
            self::SATURDAY->value,
            self::SUNDAY->value,
            self::SATURDAY_AND_SUNDAY->value,
        ];
    }

}



