<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransportManual\TransportBrandCollection;
use App\Http\Responses\ApiJsonResponse;
use App\Services\TransportManualService;

class TransportBrandController extends Controller
{
    public function __construct(
        private TransportManualService $service
    ) {
        $this->service = new TransportManualService;
    }

    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(data: new TransportBrandCollection($this->service->getBrand()));
    }
}
