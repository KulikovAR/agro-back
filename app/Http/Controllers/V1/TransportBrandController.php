<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiJsonResponse;
use App\Services\TransportManualService;
use App\Http\Resources\TransportManual\TransportBrandCollection;

class TransportBrandController extends Controller
{
    public function __construct(
        private TransportManualService $service
    ) {
        $this->service = new TransportManualService;
    }


    public function index():ApiJsonResponse
    {  
        return new ApiJsonResponse(data:new TransportBrandCollection($this->service->getBrand()));
    }
}
