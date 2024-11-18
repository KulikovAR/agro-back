<?php

namespace App\Enums;

enum FileTypeEnum: string
{
    case ACT = 'Акт';
    case REQUEST = 'Заявка';
    case CONTRACT = 'Договор';
    case AVATAR = 'Аватар';
    case PSFL = 'ПСФЛ';
    case EFS = 'ЕФС';
    case REQUISITES = 'Реквизиты';
    case TAX_SERCET = 'Налоговая тайна';
    case PATENT = 'Патент';
    case USN = 'УСН';
    case NDS = 'НДС';

    public static function getValues(): array
    {
        return [
            self::ACT->value,
            self::REQUEST->value,
            self::CONTRACT->value,
            self::AVATAR->value,
            self::PSFL->value,
            self::EFS->value,
            self::REQUISITES->value,
            self::PATENT->value,
            self::USN->value,
            self::NDS->value,
            self::TAX_SERCET->value,
        ];
    }

    public static function randomCase()
    {
        $arr = [
            self::ACT->value,
            self::REQUEST->value,
            self::CONTRACT->value,
        ];

        return $arr[array_rand($arr)];
    }
}
