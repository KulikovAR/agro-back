<?php
namespace App\Services\Sms;
use App\Enums\SmsApiEnum;
use App\Services\Sms\SmsClient;



class SmsVerification

{
    private SmsClient $sender;

    public function __construct(){
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
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        // curl_setopt($curl, CURLOPT_POST, 1);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
        //     "from" => config('sms.from_company'),
        //     "message" => 213412,
        //     "to" => 79202149572,
        //     "callback_url" => SmsApiEnum::CALLBACK->value
        // ]));
        // curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        // curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, config('sms.login').':'.config('sms.passwd'));
        // curl_setopt($curl, CURLOPT_URL, "https://a2p-api.megalabs.ru/sms/v1/sms");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        // $result = json_decode(curl_exec($curl), true);
        // dd($curl);
        // curl_close($curl);
      
        // dd($result);
        // if (!empty($result['result']) && !empty($result['result']['status']) && isset($result['result']['status']['code']) && $result['result']['status']['code'] == 0) {
        //     AdmSmsLog::create($phoneNumber, $text, $result['result']['msg_id']);
        //     return $result['result']['msg_id'];
        // }

        // Yii::info('Error send SMS', 'test_category');
        // Yii::info($result, 'test_category');

        // throw new ServerErrorHttpException('SMS not sent.');
    }

    /**
     *  Имитация отправки смс записывает в логи
     */

    // public static function sendInLog($phoneNumber, $text)
    // {
    //     Yii::info('Телефон:' . $phoneNumber . ' ' . 'Пинкод:' . $text, 'test_category');
    //     return true;
    // }
}