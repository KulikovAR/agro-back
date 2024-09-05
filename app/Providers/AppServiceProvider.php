<?php

namespace App\Providers;

use App\Http\Requests\File\FromIcRequest;
use App\Models\BankAccount;
use App\Models\File;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Observers\OfferObserver;
use App\Observers\OrderObserver;
use App\Policies\BankAccountPolicy;
use App\Policies\FilePolicy;
use App\Policies\MultipleUserPolicy;
use App\Policies\UserPolicy;
use App\Repositories\FromIcRepositoryInterface;
use App\Repositories\IcRepository;
use App\Repositories\ToIcRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if(config('app.env') === 'production' || config('app.env') === 'dev') {
           Url::forceScheme('https');
        }

        Order::observe(OrderObserver::class);
        Offer::observe(OfferObserver::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(BankAccount::class, BankAccountPolicy::class);
        Gate::policy(File::class, FilePolicy::class);
    }
}
