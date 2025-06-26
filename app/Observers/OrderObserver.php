<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\ExpoNotificationService;
use App\Enums\NotificationType;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $order->order_number = $order->max('order_number') + 1;
        $order->save();

        app(ExpoNotificationService::class)->broadcastToAllUsers(
            NotificationType::ORDER_CREATED,
            getOrderNotificationData($order)
        );
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        app(ExpoNotificationService::class)->broadcastToAllUsers(
            NotificationType::ORDER_UPDATED,
            getOrderNotificationData($order)
        );
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
