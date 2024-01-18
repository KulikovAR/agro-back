<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductParser\GetProductFilterRequest;
use App\Http\Requests\ProductParser\ProductParserRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Services\ProductParser\ProductParserService;
use Illuminate\Http\Request;

class ProductParserController extends Controller
{   
    public function __construct(
        public ProductParserService $service,
    ){}
    public function getProductFilter(GetProductFilterRequest $request):ApiJsonResponse
    {   
         return new ApiJsonResponse(data:$this->service->getFilters($request->types));
    }
    public function index(ProductParserRequest $request)
    {
        
    }
}
