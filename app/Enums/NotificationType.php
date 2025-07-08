<?php

namespace App\Enums;

enum NotificationType: string
{
    case ORDER = 'order';
    case REGULAR = 'regular';
}