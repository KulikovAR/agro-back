<?php


return 
[
    'from_company' => env('FROM_COMPANY'),
    'api' => env('SMS_SERVICE_URL'),
    'callback' => env('SMS_CALLBACK'),
    'login' => env('SMS_LOGIN'),
    'passwd' => env('SMS_PASSWD'),
    'dev'    => env('DEV')
];