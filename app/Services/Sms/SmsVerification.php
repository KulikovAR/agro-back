<?php

namespace App\Services\Sms;

use App\Enums\SmsApiEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SmsVerification
{
    protected const DEFAULT_SMS_CODE = '11111';

    private SmsClient $sender;

    public function __construct()
    {
        $this->sender = new SmsClient;
    }

    public function send($phone_number, $message): void
    {
        $params = [
            'number' => $phone_number,
            'text' => $message,
            'sign' => 'SMS Aero',
        ];

        $response = $this->sender->client->get(SmsApiEnum::API->value, $params);
        if (!$response->successful()) {
            throw new BadRequestHttpException('SMS not sent.');
        }
    }

    public function setCode(): array
    {
        $code = (string)rand(10000, 99999);

        if (!app()->environment('production')) {
            $code = self::DEFAULT_SMS_CODE;
        }

        $code_hash = Hash::make($code);
        $code_expire = Carbon::now()->addSeconds(60);

        return compact('code', 'code_hash', 'code_expire');
    }
}
