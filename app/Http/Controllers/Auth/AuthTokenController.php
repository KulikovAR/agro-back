<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginEmailRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\User;
use App\Services\AuthService;
use App\Services\UserDeviceService;
use App\Services\UserService;
use App\Traits\BearerTokenTrait;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthTokenController extends Controller
{

    public function __construct(
        private AuthService $auth_service,
    ) {
        $this->auth_service = new AuthService;
    }
    use BearerTokenTrait;

    public function store(LoginRequest $request)
    {

        $user =  $this->auth_service->login($request);
        return new ApiJsonResponse(
            data: [
                'user'  => new UserResource($user),
            ]
        );
    }

    public function verification(RegistrationSmsCodeRequest $request): ApiJsonResponse
    {
        $data = $this->auth_service->verificationCheck($request);
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('login.verify_phone'),
            data: [
                'user'  => new UserResource($data['user']),
                'token' => $data['token']
            ]
        );
    }

    public function destroy(Request $request): ApiJsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return new ApiJsonResponse();
    }
}
