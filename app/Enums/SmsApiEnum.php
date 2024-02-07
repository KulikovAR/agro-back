<?php

namespace App\Enums;

enum SmsApiEnum: string
{
    case CALLBACK = 'https://dev-admin.cargis.pro/admin/sms-logs/callback';
    case API  = 'https://a2p-api.megalabs.ru/sms/v1/sms';
}
