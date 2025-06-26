<?php

use App\Models\Order;

if (! function_exists('getOrderNotificationData')) {
    function getOrderNotificationData(Order $order): array
    {
        return [
            'order_id' => $order->id,
            'load_place' => $order->load_place,
            'unload_place' => $order->unload_place_name,
            'date' => $order->updated_at->format('d.m.Y'),
            'crop' => $order->crop,
            'distance' => $order->distance,
            'tariff' => $order->tariff,
        ];
    }
}