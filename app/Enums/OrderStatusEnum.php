<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case ACTIVE = 'Активная';
    case PAUSED = 'На паузе';
    case DONE = 'Завершённые';
    case WITH_MY_FEEDBACK = 'С моим откликом';

    public static function getOrderStatus(): array
    {
        $arr =  [
            self::ACTIVE->value,
            self::PAUSED->value,
            self::DONE->value,
        ];
        return array_combine(array_values($arr), $arr);
    }
}
