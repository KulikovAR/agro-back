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
use Laravel\Sanctum\PersonalAccessToken;
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
        $codeData = $this->sms->setCode();

        $user = $this->findOrCreateUser($request->phone_number);

        $this->assignUserRole($user);

        } else {
        $this->sendVerificationCode($request->phone_number, $codeData);

        $this->saveVerificationCode($user, $codeData);

        $resource = $this->createUserResource($user);

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

        if ($user->code !== $request->code) {
            throw new BadRequestException('Неверный код');
        }

        $bearerToken = $this->createAuthToken($user);

        if ($request->device_token) {
            $user->deviceTokens()->updateOrCreate(
                ['token' => $request->device_token]
            );
        }

        return ['user' => $user, 'token' => $bearerToken];
    }

    public function destroy(User $user, ?string $deviceToken): void
    {
        $user->tokens()->delete();

        $user->deviceTokens()
            ->where('token', $deviceToken)
            ->delete();
    }

    public function getUser(Request $request)
    {
        $token = $request->bearerToken();
        $user_token = PersonalAccessToken::findToken($token);

        return User::where('id', $user_token->tokenable_id)->first();
    }


    private function findOrCreateUser(string $phoneNumber): User
    {
        $user = User::firstOrNew(
            ['phone_number' => $phoneNumber],
            [
                'phone_number' => $phoneNumber,
                'moderation_status' => ModerationStatusEnum::APPROVED->value
            ]
        );

        if (!$user->exists) {
            $user->save();
            $user->update($user->clearProfile());
        }

        return $user;
    }

    private function assignUserRole(User $user): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $logisticianRole = Role::where('name', 'logistician')->first();

        if ($user->hasRole($logisticianRole)) {
            $user->syncRoles($logisticianRole);
        } else {
            $user->syncRoles([$clientRole]);
        }
    }

    private function sendVerificationCode(string $phoneNumber, array $codeData): void
    {
        $this->sms->send($phoneNumber, $codeData['code'] . '- Код для подтверждения');
    }

    private function saveVerificationCode(User $user, array $codeData): void
    {
        $user->update([
            'code' => $codeData['code'],
            'code_hash' => $codeData['codeHash'],
            'code_expire_at' => $codeData['codeExpire']
        ]);
    }

    private function createUserResource(User $user): LoginResource|DevUserResource
    {
        return config('app.env') === 'production'
            ? new LoginResource($user)
            : new DevUserResource($user);
    }
}
