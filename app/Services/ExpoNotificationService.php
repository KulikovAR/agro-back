<?php

namespace App\Services;

use App\Models\User;
use App\Enums\NotificationType;
use NotificationChannels\Expo\ExpoMessage;
use Illuminate\Notifications\Notification;

class ExpoNotificationService
{
    public function send(User $user, NotificationType|Notification $notification, ?array $data = null): void
    {
        if ($user->deviceTokens->isEmpty()) {
            return;
        }

        $notificationObject = $notification instanceof Notification 
            ? $notification 
            : $this->createNotification($notification, $data);
            
        $user->notify($notificationObject);
    }

    private function createNotification(NotificationType $type, array $data): Notification
    {
        return new class($type, $data) extends Notification
        {
            public function __construct(
                private readonly NotificationType $type,
                private readonly array $data
            ) {}

            public function via($notifiable): array
            {
                return ['expo'];
            }

            public function toExpo($notifiable): ExpoMessage
            {
                return ExpoMessage::create()
                    ->title($this->getTitle())
                    ->body($this->getMessage())
                    ->data(array_merge($this->data, ['type' => $this->type->value]));
            }

            private function getTitle(): string
            {
                return match($this->type) {
                    NotificationType::ORDER_CREATED => 'Агро-Логистика / Новая заявка',
                    NotificationType::ORDER_UPDATED => 'Агро-Логистика / Изменения в Заявке',
                    default => 'Агро-Логистика'
                };
            }

            private function getMessage(): string
            {
                if (isset($this->data['custom_message'])) {
                    return $this->data['custom_message'];
                }

                return $this->buildOrderNotificationMessage();
            }

            private function buildOrderNotificationMessage(): string
            {
                return sprintf(
                    '%s -> %s / %s / %s / %d км / %d р/тн',
                    $this->data['load_place'],
                    $this->data['unload_place'],
                    $this->data['date'],
                    $this->data['crop'],
                    $this->data['distance'],
                    $this->data['tariff']
                );
            }
        };
    }

    public function broadcastToAllUsers(NotificationType|Notification $notification, ?array $data = null): void
    {
        $users = User::whereHas('deviceTokens')->get();
        
        foreach ($users as $user) {
            $this->send($user, $notification, $data);
        }
    }

    public function broadcastCustomMessage(string $title, string $message): void
    {
        $customNotification = new class($title, $message) extends Notification
        {
            public function __construct(
                private readonly string $title,
                private readonly string $message
            ) {}

            public function via($notifiable): array
            {
                return ['expo'];
            }

            public function toExpo($notifiable): ExpoMessage
            {
                return ExpoMessage::create()
                    ->title($this->title)
                    ->body($this->message)
                    ->data(['type' => 'custom']);
            }
        };

        $this->broadcastToAllUsers($customNotification);
    }
}