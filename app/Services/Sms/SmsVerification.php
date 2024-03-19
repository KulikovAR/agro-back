<?php

namespace App\Services\Sms;

use App\Enums\SmsApiEnum;
use App\Services\Sms\SmsClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SmsVerification

{
  private SmsClient $sender;

  public function __construct()
  {
    $this->sender = new SmsClient;
  }
  public function send($phone_number, $message): void
  {
    $params = array(
        "number" => $phone_number,
        "text" => $message,
        "sign"  => 'SMS Aero',
//      "callback_url" => SmsApiEnum::CALLBACK->value
    );

    $response = $this->sender->client->get(SmsApiEnum::API->value, $params);

    if(!$response->successful()) {
        throw new BadRequestHttpException('SMS not sent.');
    }
  }

  /**
   *  Имитация отправки смс записывает в логи
   */

  // public static function sendInLog($phoneNumber, $text)
  // {
  //     Yii::info('Телефон:' . $phoneNumber . ' ' . 'Пинкод:' . $text, 'test_category');
  //     return true;
  // }



  public function setCode()
  {
    $code = (string)rand(10000, 99999);
    $code_hash = Hash::make($code);
    $code_expire = Carbon::now()->addSeconds(60);
    return array('code' => $code, 'code_hash' => $code_hash, 'code_expire' => $code_expire);
  }
}
