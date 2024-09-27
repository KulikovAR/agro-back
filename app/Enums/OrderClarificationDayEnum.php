<?php

namespace App\Enums;

enum OrderClarificationDayEnum: string
{
    case SATURDAY = 'суббота';
    case SUNDAY = 'воскресенье';
    case SATURDAY_AND_SUNDAY = 'суббота и воскресенье';

    public static function getValue(): array
    {
        return [
            self::SATURDAY->value,
            self::SUNDAY->value,
            self::SATURDAY_AND_SUNDAY->value,
        ];
    }
}
