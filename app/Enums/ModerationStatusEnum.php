<?php

namespace App\Enums;

enum ModerationStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public static function getDescriptions(): array
    {
        return [
            self::PENDING->value => 'На модерации',
            self::APPROVED->value => 'Профиль подтвержден',
            self::REJECTED->value => 'Профиль не подтвержден',
        ];
    }

    public static function getModerationStatus($value): ?string
    {
        if ($value != null) {
            return match ($value) {
                self::PENDING->value => 'На модерации',
                self::APPROVED->value => 'Профиль подтвержден',
                self::REJECTED->value => 'Профиль не подтвержден',
            };
        }

        return null;
    }
}
