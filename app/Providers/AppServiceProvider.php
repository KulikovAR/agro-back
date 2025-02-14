<?php

namespace App\Providers;

use App\Models\BankAccount;
use App\Models\File;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Observers\OfferObserver;
use App\Observers\OrderObserver;
use App\Policies\BankAccountPolicy;
use App\Policies\FilePolicy;
use App\Policies\UserPolicy;
use App\Repositories\FromIcRepositoryInterface;
use App\Repositories\IcRepository;
use App\Repositories\ToIcRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ToIcRepositoryInterface::class, IcRepository::class);
        $this->app->bind(FromIcRepositoryInterface::class, IcRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || config('app.env') === 'develop') {
            Url::forceScheme('https');
        }

        if ((config('app.env') === 'dev' || config('app.env') === 'local' ) && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Order::observe(OrderObserver::class);
        Offer::observe(OfferObserver::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(BankAccount::class, BankAccountPolicy::class);
        Gate::policy(File::class, FilePolicy::class);
    }
}
