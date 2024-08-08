<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case LOGISTICIAN = 'logistician';
    case CLIENT = 'client';
    case IC = '1C';

    public static function getWithDescription()
    {
        return [
            self::ADMIN->value       => 'Администратор',
            self::LOGISTICIAN->value => 'Логист',
            self::CLIENT->value      => 'Клиент',
            self::IC->value => '1C'
        ];
    }
}
