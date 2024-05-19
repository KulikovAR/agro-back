<?php

namespace App\Enums;

enum OrderTimeslotEnum: string
{
    case TARGET = 'Целевой';
    case IN_THE_PUBLIC_DOMAIN = 'В общем доступе';

    public static function getTimselot(): array
    {
        return  [
            self::TARGET->value,
            self::IN_THE_PUBLIC_DOMAIN->value,
        ];
    }
}
