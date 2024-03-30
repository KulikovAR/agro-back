<?php

namespace App\Enums;

enum OrderClarificationDayEnum: string
{
    case SATURDAY = 'saturday';
    case SUNDAY = 'sunday';
    case SATURDAY_AND_SUNDAY = 'saturday_and_sunday';


    public static function getWithDescription(): array
    {
        return [
            self::SATURDAY->value            => 'Суббота',
            self::SUNDAY->value              => 'Воскресенье',
            self::SATURDAY_AND_SUNDAY->value => 'Суббота и воскресенье'
        ];
    }
}



