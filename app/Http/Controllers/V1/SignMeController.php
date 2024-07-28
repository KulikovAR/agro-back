<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignMe\SignMeRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Services\SignMeService;
use Illuminate\Http\Request;

class SignMeController extends Controller
{
    private SignMeService $signMeService;
    public function __construct()
    {
        $this->signMeService = new SignMeService();
    }

    public function signature (SignMeRequest $request): ApiJsonResponse
    {
        if(gettype($this->signMeService->signature($request)) == 'string'){
            return new ApiJsonResponse(200, StatusEnum::OK, $this->signMeService->signature($request), data:[]);
        }
        return new ApiJsonResponse(200, StatusEnum::OK, '', data:$this->signMeService->signature($request));
    }
}
