<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Requests\Auth\RegistrationEmailRequest;
use App\Http\Requests\Auth\RegistrationPhoneRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\User;
use App\Services\Sms\SmsVerification;
use App\Traits\BearerTokenTrait;
use App\Traits\PasswordHash;
use Carbon\Carbon;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RegisterService


{
    use BearerTokenTrait;
    use PasswordHash;
    private function setCode()
    {
        $code = (string)rand(10000, 99999);
        $code_hash = Hash::make($code);
        $code_expire = Carbon::now();

        return array('code' => $code, 'code_hash' => $code_hash, 'code_expire' => $code_expire);
    }


    public function registration(RegistrationPhoneRequest $request): User
    {

        $code_arr = $this->setCode();
        $sms = new SmsVerification;
        $sms->send($request->phone_number, $code_arr['code'] . '- Verification code Cargis');
        $user = User::create([
            'phone'    => $request->phone,
            'code'     => $code_arr['code'],
            'code_hash' => $code_arr['hash'],
            'code_expire' => $code_arr['code_expire']
        ]);
        event(new RegisteredUserEvent($user));
        // Auth::login($user); //session login

        return $user;

    }


    public function verificationCheck(RegistrationSmsCodeRequest $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();
        if($user->code == $request->code){
            $bearerToken = $this->CreateAuthToken($user, Browser::userAgent());
            return array('user'=>$user, 'token'=>$bearerToken);
        }
        throw new BadRequestException ('Неверный код');
    }
}
