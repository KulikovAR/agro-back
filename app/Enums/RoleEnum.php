<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case LOGISTICIAN = 'logistician';
    case CLIENT = 'client';
    case MANAGER = 'manager';
    case IC = '1C';

    public static function getWithDescription()
    {
        return [
            self::ADMIN->value => 'администратор',
            self::LOGISTICIAN->value => 'логист',
            self::CLIENT->value => 'клиент',
            self::MANAGER->value => 'менеджер',
            self::IC->value => '1с',
        ];
    }
}
