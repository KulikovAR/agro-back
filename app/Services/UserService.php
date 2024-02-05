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

class UserService


{
    private $sms;

    public function __construct()
    {
        $this->sms = new SmsVerification;
    }

    public function updateCode(User $user)
    {
        $code_arr = $this->sms->setCode();
        $this->sms->send($user->phone_number, $code_arr['code'] . '- Verification code Cargis');
        $user->update(['code' => $code_arr['code']]);
    } 
}
