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
  public function send($phone_number, $message)
  {
    /* реализация для smsAero
            $smsAeroParams = Yii::$app->params["smsAero"];
            $smsAero = new ApiClass($smsAeroParams["email"],$smsAeroParams["key"],$smsAeroParams["sign"]);
            return $smsAero->send($phoneNumber,$text);
        */
    $params = array(
      "from" => config('sms.from_company'),
      "message" => $message,
      "to" => $phone_number,
      "callback_url" => SmsApiEnum::CALLBACK->value
    );
    $response = $this->sender->client->post(SmsApiEnum::API->value, $params);
    dd($response);

    throw new BadRequestHttpException('SMS not sent.');
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
