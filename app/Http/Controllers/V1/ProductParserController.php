<?php

namespace App\Http\Controllers\V1;

use App\Filters\ProductParserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductParser\GetProductFilterRequest;
use App\Http\Requests\ProductParser\ProductParserRequest;
use App\Http\Resources\ProductParser\ProductParserCollection;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Product;
use App\Services\ProductParser\ProductParserService;

class ProductParserController extends Controller
{
    public function __construct(
        public ProductParserService $service,
    ) {
    }

    public function getProductFilter(GetProductFilterRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(data: $this->service->getFilters($request->types));
    }

    public function index(ProductParserRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProductParserFilter::class, ['queryParams' => array_filter($data)]);
        $products = Product::filter($filter)->get();

        return new ApiJsonResponse(data: new ProductParserCollection($products));
    }
}
