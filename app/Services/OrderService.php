<?php

namespace App\Services;

use App\Filters\OrderFilter;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderFilterRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\Order\OrderCreateResource;
use App\Http\Resources\Order\OrderIndexCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;

class OrderService
{

    public function index(OrderFilterRequest $request): OrderIndexCollection
    {
        $data   = $request->validated();
        $filter = app()->make(OrderFilter::class, ['queryParams' => array_filter($data)]);
        $order   = Order::filter($filter);
        return new OrderIndexCollection($order->orderBy('created_at','desc')->get());
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

    public function update(OrderUpdateRequest $request ,Order $order): OrderResource
    {
        $order->update($request->except(['load_types']));
        if(!is_null($request->load_types)){
            foreach($request->load_types as $load_type){
                $order->loadTypes()->sync($load_type);
            }
        }
        return new OrderResource($order);
    }

    public function delete(Order $order):void
    {
        $order->delete();
    }
}
