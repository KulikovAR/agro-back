<?php

namespace App\Services;

use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Resources\Order\OrderCreateResource;
use App\Http\Resources\Order\OrderIndexCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;

class OrderService
{

    public function index(): OrderIndexCollection
    {
        return new OrderIndexCollection(Order::all());
    }

    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function create(OrderCreateRequest $request): OrderCreateResource
    {
        $order = Order::create($request->except(['load_types']));
        foreach ($request->load_types as $load_type) {
            $order->loadTypes()->attach($load_type);
        }
        return new OrderCreateResource($order);
    }
}
