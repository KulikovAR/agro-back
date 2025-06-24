<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Services\AuthService;
use App\Traits\BearerTokenTrait;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function __construct(
        private AuthService $auth_service,
    ) {
        $this->auth_service = new AuthService;
    }

    use BearerTokenTrait;

    public function store(LoginRequest $request): ApiJsonResponse
    {

        $user = $this->auth_service->login($request);

        return $user;
    }

    public function verification(RegistrationSmsCodeRequest $request): ApiJsonResponse
    {
        $data = $this->auth_service->verificationCheck($request);

        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('login.verify_phone'),
            data: [
                'user' => new UserResource($data['user']),
                'token' => $data['token'],
            ]
        );
    }

    public function getUser(Request $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('login.verify_phone'),
            data: [
                'user' => new UserResource($this->auth_service->getUser($request)),
            ]
        );
    }

    public function destroy(Request $request): ApiJsonResponse
    {
        $user = $request->user();
        
        $user->tokens()->delete();
        
        if ($request->device_token) {
            $user->deviceTokens()
                ->where('token', $request->device_token)
                ->delete();
        }
    
        return new ApiJsonResponse;
    }
}
