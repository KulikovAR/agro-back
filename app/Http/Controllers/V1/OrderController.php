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
use Illuminate\Http\Request;

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
                $this->service->create($request),
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
                $this->service->update($request, $order),
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

    public function getRegions()
    {
        return new ApiJsonResponse(
            data: $this->service->getRegions()
        );
    }

    public function getCities(OrderCitiesRequest $request)
    {
        return new ApiJsonResponse(
            data: $this->service->getCities($request)
        );
    }

    public function getOrdersWithUserOffers(Request $request)
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Заявки с откликами пользователя получены', data: $this->service->getOrdersWithUserOffers($request));
    }

    public function notifyLogistician(Offer $offer): ApiJsonResponse
    {

    }
}
