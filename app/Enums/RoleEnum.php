<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case CARRIER = 'carrier';
    case SHIPPER = 'shipper';
    case DRIVER = 'driver';
    case LOGISTICIAN = 'logistician';
    case EXPEDITOR = 'expeditor';
    case CLIENT = 'client';

    public static function getWithDescription()
    {
        return [
            self::ADMIN->value       => 'Администратор',
            self::CARRIER->value     => 'Перевозичк',
            self::SHIPPER->value     => 'Заказчик',
            self::DRIVER->value      => 'Водитель',
            self::LOGISTICIAN->value => 'Логист',
            self::EXPEDITOR->value   => 'Экспедитор',
            self::CLIENT->value      => 'Клиент',
        ];
    }
}
