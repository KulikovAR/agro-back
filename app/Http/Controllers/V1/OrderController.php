<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
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
    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявки получены',
            data: [
                $this->service->index()
            ]
        );
    }


    public function show(Order $order): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка получена',
            data: [
                $this->service->show($order)
            ]
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
}
