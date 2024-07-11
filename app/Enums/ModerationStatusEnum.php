<?php

namespace App\Enums;

enum ModerationStatusEnum: string
{
    case Pending = 'На модерации';
    case Approved = 'Одобрено';
    case Rejected = 'Отклонено';

    public static function getDescriptions(): array
    {
        return [
            'pending' => self::Pending->value,
            'approved' => self::Approved->value,
            'rejected' => self::Rejected->value,
        ];
    }

    public static function getModerationStatus($status): string
    {
        return self::getDescriptions()[$status];
    }

}


