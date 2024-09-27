<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\OfferRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Services\OfferService;

class OfferController extends Controller
{
    public function __construct(
        private OfferService $service
    ) {
        $this->service = new OfferService;
    }

    public function create(OfferRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200, StatusEnum::OK, 'Отклик создан', data: $this->service->create($request)
        );
    }
}
