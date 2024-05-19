<?php

namespace App\Enums;

enum OrderTimeslotEnum: string
{
    case TARGET = 'Целевой';
    case IN_THE_PUBLIC_DOMAIN = 'В общем доступе';

    public static function getTimselot(): array
    {
        $arr = [
            self::TARGET->value,
            self::IN_THE_PUBLIC_DOMAIN->value,
        ];
        return array_combine(array_values($arr), $arr);
    }
}
