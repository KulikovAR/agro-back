<?php

namespace App\Enums;

enum LoadMethodEnum: string
{
    case MANITU = 'Маниту';
    case GRAIN_MILL = 'Зерномёт';
    case KUN = 'Кун';
    case AMKODOR = 'Амкодор';
    case BY_THE_TUBE = 'Из-под трубы';
    case COMBINE = 'Комбайн';
    case ELEVATOR = 'Элеватор';
    case VERTICAL = 'Вертикальный';

    public static function getLoadMethods(): array
    {
        return [
            self::MANITU->value,
            self::GRAIN_MILL->value,
            self::KUN->value,
            self::AMKODOR->value,
            self::BY_THE_TUBE->value,
            self::COMBINE->value,
            self::ELEVATOR->value,
            self::VERTICAL->value,
        ];
    }
}
