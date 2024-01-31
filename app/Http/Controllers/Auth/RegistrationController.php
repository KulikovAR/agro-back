<?php

namespace App\Http\Controllers\Auth;

use App\Enums\EnvironmentTypeEnum;
use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationEmailRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Role;
use App\Models\User;
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
    use BearerTokenTrait;
    use PasswordHash;

    public function emailRegistration(RegistrationEmailRequest $request): ApiJsonResponse
    {
        $sms = new SmsVerification;
        $sms->
      

        // $user->assignRole(Role::ROLE_USER);

        // $user->userProfile()
        //     ->updateOrCreate(
        //         ['user_id' => $user->id],
        //         [
        //             'firstname' => $request->firstname,
        //             'lastname'  => $request->lastname
        //         ]
        //     );
        
     

        $user = User::create([
            'phone'    => Str::lower($request->phone),
        ]);
        $bearerToken = $this->createAuthToken($user, Browser::userAgent());

        event(new RegisteredUserEvent($user));

        Auth::login($user); //session login
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __('registration.verify_email'),
            data: [
                'user'  => new UserResource($user),
                'token' => $bearerToken,
            ]
        );
    }
}