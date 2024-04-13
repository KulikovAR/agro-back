<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCitiesRequest;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderFilterRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Order;
use App\Services\OrderService;


class OrderController extends Controller
{

    public function __construct(
        private OrderService $service
    ) {
        $this->service = new OrderService;
    }

    public function index(OrderFilterRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявки получены',
            data: $this->service->index($request)

        );
    }


    public function show(Order $order): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка получена',
            data: $this->service->show($order)
        );
    }

    public function create(OrderCreateRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка создана',
            data: [
                $this->service->create($request)
            ]
        );
    }

    public function update(OrderUpdateRequest $request, Order $order): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка обновлена',
            data: [
                $this->service->update($request, $order)
            ]
        );
    }


    public function delete(Order $order): ApiJsonResponse
    {
        $this->service->delete($order);
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка удалена',
            data: [

            ]
        );
    }

    public function getOptions(): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Типы загрузок получены',
            data: $this->service->getOptions()
        );
    }

    public function getRegions() {
        $regions = Order::whereNotNull('load_region')->get()->pluck('load_region')->toArray();

        $regions = array_unique($regions);
        return new ApiJsonResponse(data:
            $regions
        );
    }

    public function getCities(OrderCitiesRequest $request) {
        $cities = Order::where('load_region', $request->region)->get()->pluck('load_city')->toArray();

        $cities = array_unique($cities);
        return new ApiJsonResponse(data:
            $cities
        );
    }
}

