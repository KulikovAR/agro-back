<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case LOGISTICIAN = 'logistician';
    case CLIENT = 'client';

    public static function getWithDescription()
    {
        return [
            self::ADMIN->value       => 'Администратор',
            self::LOGISTICIAN->value => 'Логист',
            self::CLIENT->value      => 'Клиент',
        ];
    }
}
