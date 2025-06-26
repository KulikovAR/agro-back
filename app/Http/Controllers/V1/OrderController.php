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
use App\Enums\NotificationType;
use App\Services\ExpoNotificationService;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $service,
        private ExpoNotificationService $pushService
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

    public function exportLocal(OrderFilterRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявки получены',
            data: $this->service->exportLocal($request)
        );
    }

    public function exportPublic(OrderFilterRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявки получены',
            data: $this->service->exportPublic($request)
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
        $order = $this->service->create($request);
        
        $this->pushService->broadcastToAllUsers(
            NotificationType::ORDER_CREATED,
            [
                'order_id' => $order->id,
                'load_place' => $order->load_place,
                'unload_place' => $order->unload_place_name,
                'date' => $order->updated_at->format('d.m.Y'),
                'crop' => $order->crop,
                'distance' => $order->distance,
                'tariff' => $order->tariff
            ]
        );
        
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка создана',
            data: [$order]
        );
    }

    public function update(OrderUpdateRequest $request, Order $order): ApiJsonResponse
    {
        $updatedOrder = $this->service->update($request, $order);
        
        $this->pushService->broadcastToAllUsers(
            NotificationType::ORDER_UPDATED,
            [
                'order_id' => $updatedOrder->id,
                'load_place' => $updatedOrder->load_place,
                'unload_place' => $updatedOrder->unload_place_name,
                'date' => $updatedOrder->updated_at->format('d.m.Y'),
                'crop' => $updatedOrder->crop,
                'distance' => $updatedOrder->distance,
                'tariff' => $updatedOrder->tariff
            ]
        );
        
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Заявка обновлена',
            data: [$updatedOrder]
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
}
