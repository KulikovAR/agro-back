<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Requests\Auth\LoginRequest;

use App\Http\Requests\Auth\RegistrationPhoneRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\DevUserResource;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Role;
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
    use BearerTokenTrait;

    private $sms;

    public function __construct()
    {
        $this->sms = new SmsVerification;
    }

    use PasswordHash;

    public function login(LoginRequest $request): ApiJsonResponse
    {
        $code_arr = $this->sms->setCode();

        $clientRole = Role::where('name', 'client')->first();
        $logisticianRole = Role::where('name', 'logistician')->first();

        $user = User::firstOrCreate(['phone_number' => $request->phone_number],['phone_number' => $request->phone_number]);
        if($user->hasRole($logisticianRole)) {
            $user->syncRoles($logisticianRole);
        }
        else{
        $user->syncRoles([$clientRole]);
        }
        $user->userProfile()->create($user->clearProfile());
        if (env('APP_ENV') == 'production') {
            $this->sms->send($request->phone_number, $code_arr['code'] . '- Verification code Cargis');
            $resource = new UserResource($user);
        }

        $resource = new DevUserResource($user);
        $user->update(['code' => $code_arr['code'], 'code_hash' => $code_arr['code_hash'], 'code_expire_at' => $code_arr['code_expire']]);

        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('login.verify_phone'),
            data: [
                'user' => $resource,
            ]
        );
    }


    public function verificationCheck(RegistrationSmsCodeRequest $request): array
    {
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user->code == $request->code) {
            $bearerToken = $this->createAuthToken($user);
            return array('user' => $user, 'token' => $bearerToken);
        }
        throw new BadRequestException('Неверный код');
    }

    public function getUser(Request $request)
    {
        $token = $request->bearerToken();
        $user_token = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        return User::where('id', $user_token->tokenable_id)->first();
    }


}
