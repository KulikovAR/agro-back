<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class AppVersionService
{
    /**
     * Получить самую актуальную версию приложения
     */
    public function getLatestVersion(): string
    {
        // В реальном проекте здесь может быть логика получения версии из конфига или БД
        return config('app.latest_version', '1.0.0');
    }

    /**
     * Сохранить версию приложения для пользователя
     */
    public function saveUserVersion(User $user, string $version): bool
    {
        try {
            $user->update(['app_version' => $version]);
            return true;
        } catch (\Exception $e) {
            Log::error('Ошибка сохранения версии приложения', [
                'user_id' => $user->id,
                'version' => $version,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Получить версию приложения пользователя
     */
    public function getUserVersion(User $user): ?string
    {
        return $user->app_version;
    }

    /**
     * Проверить, нужна ли обновление приложения
     */
    public function needsUpdate(User $user): bool
    {
        $userVersion = $this->getUserVersion($user);
        $latestVersion = $this->getLatestVersion();

        if (!$userVersion) {
            return false; // Если версия не установлена, считаем что обновление не нужно
        }

        return version_compare($userVersion, $latestVersion, '<');
    }
} 