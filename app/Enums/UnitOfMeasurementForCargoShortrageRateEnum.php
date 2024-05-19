<?php

namespace App\Enums;

enum UnitOfMeasurementForCargoShortrageRateEnum: string
{
    case PERCENT = '%';
    case KILOGRAMM = 'КГ';

    public static function getValue(): array
    {
        $arr =  [
            self::PERCENT->value,
            self::KILOGRAMM->value,
        ];
        return array_combine(array_values($arr), $arr);
    }
}
