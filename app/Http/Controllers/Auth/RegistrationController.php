<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationPhoneRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\User;
use App\Services\RegisterService;
use App\Services\UserService;

class RegistrationController extends Controller
{
    private RegisterService $register_service;

    private UserService $user_service;

    public function __construct()
    {
        $this->register_service = new RegisterService;

        $this->user_service = new UserService;
    }

    public function registration(RegistrationPhoneRequest $request): ApiJsonResponse
    {
        $user = $this->register_service->registration($request);

        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('registration.verify_phone'),
            data: [
                'user' => new UserResource($user),
            ]
        );
    }

    public function verification(RegistrationSmsCodeRequest $request): ApiJsonResponse
    {
        $data = $this->register_service->verificationCheck($request);
        if (array_key_exists('message', $data)) {
            return new ApiJsonResponse(
                400,
                StatusEnum::OK,
                __('Неверный код'),
                data: []
            );
        }

        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('registration.verify_phone'),
            data: [
                'user' => new UserResource($data['user']),
                'token' => $data['token'],
            ]
        );
    }

    public function codeUpdate(User $user)
    {
        $this->user_service->updateCode($user);

        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            data: new UserResource($user),
        );
    }
}
