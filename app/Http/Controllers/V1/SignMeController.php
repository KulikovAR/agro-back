<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignMe\SignMeRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Repositories\IcRepository;
use App\Services\SignMeService;

class SignMeController extends Controller
{
    private SignMeService $signMeService;

    public function __construct()
    {
        $this->signMeService = new SignMeService(new IcRepository);
    }

    public function signature(SignMeRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, $this->signMeService->signature($request), data: []);
    }
}
