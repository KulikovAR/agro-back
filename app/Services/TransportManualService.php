<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;

use App\Http\Requests\Auth\RegistrationPhoneRequest;
use App\Http\Requests\Auth\RegistrationSmsCodeRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Transport;
use App\Models\TransportBrand;
use App\Models\TransportType;
use App\Models\User;
use App\Services\Sms\SmsVerification;
use App\Traits\BearerTokenTrait;
use App\Traits\PasswordHash;
use Carbon\Carbon;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TransportManualService


{
    public function getType():Collection
    {
        return TransportType::all();
    }


    public function getBrand():Collection
    {
        return TransportBrand::all();
    }
}
