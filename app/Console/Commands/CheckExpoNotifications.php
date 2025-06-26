<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\DeviceToken;
use Illuminate\Console\Command;

class CheckExpoNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expo:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверяет статус Expo уведомлений и статистику';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Проверка статуса Expo уведомлений...');
        
        // Общая статистика пользователей
        $totalUsers = User::count();
        $usersWithTokens = User::whereHas('deviceTokens')->count();
        $totalTokens = DeviceToken::count();
        
        $this->info("📊 Статистика:");
        $this->line("   • Всего пользователей: {$totalUsers}");
        $this->line("   • Пользователей с device tokens: {$usersWithTokens}");
        $this->line("   • Всего device tokens: {$totalTokens}");
        
        if ($usersWithTokens > 0) {
            $percentage = round(($usersWithTokens / $totalUsers) * 100, 2);
            $this->line("   • Процент пользователей с токенами: {$percentage}%");
        }
        
        // Детальная информация о пользователях с токенами
        if ($usersWithTokens > 0) {
            $this->newLine();
            $this->info("👥 Пользователи с device tokens:");
            
            $users = User::whereHas('deviceTokens')
                ->with('deviceTokens')
                ->get();
                
            foreach ($users as $user) {
                $tokenCount = $user->deviceTokens->count();
                $tokens = $user->deviceTokens->pluck('token')->implode(', ');
                
                $this->line("   • ID: {$user->id}");
                $this->line("     Phone: {$user->phone_number}");
                $this->line("     Tokens: {$tokenCount}");
                $this->line("     Token list: {$tokens}");
                $this->newLine();
            }
        } else {
            $this->warn("⚠️  Нет пользователей с device tokens!");
        }
        
        // Проверка конфигурации
        $this->newLine();
        $this->info("⚙️  Конфигурация:");
        $this->line("   • Expo Access Token: " . (config('expo.access_token') ? '✅ Установлен' : '❌ Не установлен'));
        $this->line("   • Environment: " . config('app.env'));
        
        $this->newLine();
        $this->info("✅ Проверка завершена!");
        
        return 0;
    }
}
