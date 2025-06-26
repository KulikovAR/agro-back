<?php

namespace App\Enums;

enum NotificationType: string
{
    case ORDER_CREATED = 'order_created';
    case ORDER_UPDATED = 'order_updated';
    case REGULAR = 'regular';
}