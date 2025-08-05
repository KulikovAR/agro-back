<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\ExpoNotificationService;
use App\Enums\NotificationType;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $order->order_number = $order->max('order_number') + 1;
        $order->save();

        try {
            $notificationData = getOrderNotificationData($order);
            $notificationData['action'] = 'created';

            Log::info('Sending ORDER_CREATED notification', [
                'order_id' => $order->id,
                'data' => $notificationData
            ]);

            app(ExpoNotificationService::class)->broadcastToAllUsers(
                NotificationType::ORDER,
                $notificationData
            );
        } catch (\Exception $e) {
            Log::error('Failed to send ORDER_CREATED notification', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        try {
            $notificationData = getOrderNotificationData($order);
            $notificationData['action'] = 'updated';

            Log::info('Sending ORDER_UPDATED notification', [
                'order_id' => $order->id,
                'data' => $notificationData
            ]);

            app(ExpoNotificationService::class)->broadcastToAllUsers(
                NotificationType::ORDER,
                $notificationData
            );
        } catch (\Exception $e) {
            Log::error('Failed to send ORDER_UPDATED notification', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
        }
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
