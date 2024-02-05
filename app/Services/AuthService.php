<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Requests\Auth\LoginRequest;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthService


{
    private $sms;

    public function __construct()
    {
        $this->sms = new SmsVerification;
    }

    use PasswordHash;
    
    public function login(LoginRequest $request):User
    {   
        $code_arr = $this->sms->setCode();
        if(env('APP_ENV')=='production'){
        $this->sms->send($request->phone_number, $code_arr['code'] . '- Verification code Cargis');
        }
        $user= User::where('phone_number', $request->phone_number)->first();
        if($user->phone_verified_at==null){
            return response()->json(['message'=>'Подтвердите, пожалуйста, свой телефон'],404);
        }
        $user->update(['code' => $code_arr['code'], 'code_hash' => $code_arr['code_hash'], 'code_expire_at' => $code_arr['code_expire']]);

        return $user;
      
        
    }


    public function verificationCheck(RegistrationSmsCodeRequest $request):array
    {
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user->code == $request->code) {
            $bearerToken = $user->CreateAuthToken(Browser::userAgent());    
            return array('user' => $user, 'token' => $bearerToken);
        }
        throw new BadRequestException('Неверный код');
    }

}
