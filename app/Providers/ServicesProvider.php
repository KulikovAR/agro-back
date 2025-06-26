<?php

namespace App\Providers;

use App\Services\ExpoNotificationService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    public function register(): void
    {
        $pushService = new ExpoNotificationService();
        $this->app->instance(ExpoNotificationService::class, $pushService);
    }
}