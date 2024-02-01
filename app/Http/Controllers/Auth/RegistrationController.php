<?php

namespace App\Http\Controllers\Auth;

use App\Enums\EnvironmentTypeEnum;
use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationEmailRequest;
use App\Http\Requests\Auth\RegistrationPhoneRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Role;
use App\Models\User;
use App\Services\RegisterService;
use App\Services\Sms\SmsVerification;
use App\Traits\BearerTokenTrait;
use App\Traits\PasswordHash;
use Carbon\Carbon;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{

    private RegisterService $service;

    public function __construct()
    {
        $this->service = new RegisterService;
    }

    public function registration(RegistrationPhoneRequest $request): ApiJsonResponse
    {
        $user =  $this->service->registration($request);

        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('registration.verify_email'),
            data: [
                'user'  => new UserResource($user),
            ]
        );
    }

    public function verification(RegistrationSmsCodeRequest $request)
    {
        $data = $this->service->verificationCheck($request);
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('registration.verify_email'),
            data: [
                'user'  => new UserResource($data['user']),
                'token' => $data['token']
            ]
        );
    }
}
