<?php

namespace App\Enums;

enum OrganizationTypeEnum: string
{
    case IP              = 'ИП';
    case COMPANY         = 'Предприятие';


    public static function randomCase ()
    {   
        $arr = [self::IP->value,self::COMPANY->value];
        return $arr[array_rand($arr)];
    }

}