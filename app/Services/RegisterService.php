<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;

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
    private $sms;

    public function __construct()
    {
        $this->sms = new SmsVerification;
    }

    use PasswordHash;
    public function registration(RegistrationPhoneRequest $request): User
    {
        $code_arr = $this->sms->setCode();
        if (env('APP_ENV') == 'production') {
            $this->sms->send($request->phone_number, $code_arr['code'] . '- Verification code Cargis');
        }
        $user = User::create([
            'phone_number'    => $request->phone_number,
            'code'     => $code_arr['code'],
            'code_hash' => $code_arr['code_hash'],
            'code_expire_at' => $code_arr['code_expire']
        ]);
        event(new RegisteredUserEvent($user));
        return $user;
    }


    public function verificationCheck(RegistrationSmsCodeRequest $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user->code == $request->code) {
            $bearerToken = $this->createAuthToken($user);
            $user->update(['phone_verified_at' => Carbon::now()]);
            return array('user' => $user, 'token' => $bearerToken);
        }   
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            data: [
                'message' => 'Неверный код'
            ],
        );
    }
}
