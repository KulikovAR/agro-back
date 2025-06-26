<?php

namespace App\Services;

use App\Models\User;
use App\Enums\NotificationType;
use NotificationChannels\Expo\ExpoChannel;
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
                return [ExpoChannel::class];
            }

            public function toExpo($notifiable): ExpoMessage
            {
                return ExpoMessage::create()
                    ->title($this->getTitle())
                    ->body($this->getMessage())
                    ->setJsonData(array_merge($this->data, ['type' => $this->type->value]));
            }

            private function getTitle(): string
            {
                if ($this->type === NotificationType::ORDER) {
                    $action = $this->data['action'] ?? null;

                    return match($action) {
                        'created' => 'Агро-Логистика / Новая заявка',
                        'updated' => 'Агро-Логистика / Изменения в Заявке',
                        default => 'Агро-Логистика',
                    };
                }

                return match($this->type) {
                    NotificationType::REGULAR => 'Агро-Логистика',
                    default => 'Агро-Логистика',
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
                    $this->data['load_place'] ?? null,
                    $this->data['unload_place'] ?? null,
                    $this->data['date'] ?? null,
                    $this->data['crop'] ?? null,
                    $this->data['distance'] ?? null,
                    $this->data['tariff'] ?? null
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
                return [ExpoChannel::class];
            }

            public function toExpo($notifiable): ExpoMessage
            {
                return ExpoMessage::create()
                    ->title($this->title)
                    ->body($this->message)
                    ->setJsonData(['type' => 'custom']);
            }
        };

        $this->broadcastToAllUsers($customNotification);
    }
}
