<?php

namespace App\Services;

use App\Enums\ModerationStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\DevUserResource;
use App\Http\Resources\User\LoginResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Role;
use App\Models\User;
use App\Services\Sms\SmsVerification;
use App\Traits\BearerTokenTrait;
use App\Traits\PasswordHash;
use Illuminate\Http\Request;
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

        $user = User::firstOrNew(['phone_number' => $request->phone_number], ['phone_number' => $request->phone_number, 'moderation_status' => ModerationStatusEnum::APPROVED->value]);

        if (!User::where('phone_number', $request->phone_number)->exists()) {
            $user->save();
            $user->update($user->clearProfile());
        }

        if ($user->hasRole($logisticianRole)) {
            $user->syncRoles($logisticianRole);
        } else {
            $user->syncRoles([$clientRole]);
        }

        if (app()->environment('production')) {
            $this->sms->send($request->phone_number, $code_arr['code'] . '- Код для подтверждения');
        }

        $user->update(['code' => $code_arr['code'], 'code_hash' => $code_arr['code_hash'], 'code_expire_at' => $code_arr['code_expire']]);

        $resource = config('app.env') === 'production' ? new LoginResource($user) : new DevUserResource($user);

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

        if ($user->phone == config('auth.mobile_test_user')) {
            $bearerToken = $this->createAuthToken($user);

            if ($request->device_token) {
                $user->deviceTokens()->updateOrCreate(
                    ['token' => $request->device_token]
                );
            }

            return ['user' => $user, 'token' => $bearerToken];
        }

        if ($user->code == $request->code) {
            $bearerToken = $this->createAuthToken($user);

            if ($request->device_token) {
                $user->deviceTokens()->updateOrCreate(
                    ['token' => $request->device_token]
                );
            }

            return ['user' => $user, 'token' => $bearerToken];
        }
        throw new BadRequestException('Неверный код');
    }

    public function getUser(Request $request): User
    {
        return $request->user();
    }
}
