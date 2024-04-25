<?php

namespace App\Providers;

use App\Models\Offer;
use App\Models\Order;
use App\Observers\OfferObserver;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production' || config('app.env') === 'dev') {
           Url::forceScheme('https');
        }

        Order::observe(OrderObserver::class);
        Offer::observe(OfferObserver::class);
    }
}
