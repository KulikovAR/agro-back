<?php

namespace App\Traits;

use App\Services\ExpoNotificationService;
use App\Enums\NotificationType;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

trait SendsOrderNotifications
{
    /**
     * Отправляет push-уведомление о заявке
     */
    protected function sendOrderNotification(Model $order, string $action): void
    {
        try {
            $notificationData = getOrderNotificationData($order);
            $notificationData['action'] = $action;

            Log::info("Sending ORDER_{$action} notification", [
                'order_id' => $order->id,
                'source' => static::class,
                'data' => $notificationData
            ]);

            app(ExpoNotificationService::class)->broadcastToAllUsers(
                NotificationType::ORDER,
                $notificationData
            );
        } catch (\Exception $e) {
            Log::error("Failed to send ORDER_{$action} notification", [
                'order_id' => $order->id,
                'source' => static::class,
                'error' => $e->getMessage()
            ]);
        }
    }
}