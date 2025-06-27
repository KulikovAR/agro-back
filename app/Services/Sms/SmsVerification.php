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

    public function send(string $phoneNumber, string $message): void
    {
        if (!app()->environment('production')) {
            return;
        }

        $params = [
            'number' => $phoneNumber,
            'text' => $message,
            'sign' => 'SMS Aero',
        ];

        $response = $this->sender->client->get(SmsApiEnum::API->value, $params);

        if (!$response->successful()) {
            throw new BadRequestHttpException('Ошибка отправки SMS-сообщения, попробуйте позже');
        }
    }

    public function setCode(): array
    {
        $code = $this->generateCode();
        $codeHash = Hash::make($code);
        $codeExpire = Carbon::now()->addSeconds(60);

        return compact('code', 'codeHash', 'codeExpire');
    }

    private function generateCode(): string
    {
        if (!app()->environment('production')) {
            return self::DEFAULT_SMS_CODE;
        }

        return (string)rand(10000, 99999);
    }
}
