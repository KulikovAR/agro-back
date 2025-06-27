<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransportManual\TransportTypeCollection;
use App\Http\Responses\ApiJsonResponse;
use App\Services\TransportManualService;

class TransportTypeController extends Controller
{
    public function __construct(
        private TransportManualService $service
    )
    {
        $this->service = new TransportManualService;
    }

    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(data: new TransportTypeCollection($this->service->getType()));
    }
}
