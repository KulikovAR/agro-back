<?php

namespace App\Console\Commands;

use App\Enums\NotificationType;
use App\Models\User;
use App\Services\ExpoNotificationService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SendTestExpoNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expo:test-notification {user_id : ID пользователя для отправки уведомления}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправляет тестовое Expo push-уведомление пользователю';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');

        try {
            $user = User::findOrFail($userId);

            $this->info("Найден пользователь: {$user->phone_number}");

            if ($user->deviceTokens->isEmpty()) {
                $this->error("У пользователя нет зарегистрированных device tokens!");
                return 1;
            }

            $this->info("Найдено device tokens: " . $user->deviceTokens->count());

            $expoService = new ExpoNotificationService();

            $testData = [
                'custom_message' => 'Тестовое уведомление от Agro-Logistic',
                'timestamp' => now()->toISOString(),
                'test' => true
            ];

            $this->info("Отправляем тестовое уведомление...");

            $expoService->send($user, NotificationType::ORDER, $testData);

            $this->info("✅ Тестовое уведомление успешно отправлено!");
            $this->info("📱 Device tokens: " . $user->deviceTokens->pluck('token')->implode(', '));

            return 0;

        } catch (ModelNotFoundException $e) {
            $this->error("❌ Пользователь с ID {$userId} не найден!");
            return 1;
        } catch (\Exception $e) {
            $this->error("❌ Ошибка при отправке уведомления: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
            return 1;
        }
    }
}
