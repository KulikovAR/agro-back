<?php

namespace App\Enums;

enum UnitOfMeasurementForCargoShortrageRateEnum: string
{
    case PERCENT = '%';
    case KILOGRAMM = 'КГ';

    public static function getValue(): array
    {
        return [
            self::PERCENT->value,
            self::KILOGRAMM->value,
        ];
    }
}
