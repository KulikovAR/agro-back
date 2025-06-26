<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Expo\ExpoChannel;
use GuzzleHttp\Client;

class ExpoNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Notification::extend('expo', function ($app) {
            return new ExpoChannel(new Client());
        });
    }
} 