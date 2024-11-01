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
            self::ADMIN->value => 'Администратор',
            self::LOGISTICIAN->value => 'Логист',
            self::CLIENT->value => 'Клиент',
            self::MANAGER->value => 'Менеджер',
            self::IC->value => '1C',
        ];
    }
}
