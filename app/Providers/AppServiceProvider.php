<?php

namespace App\Providers;

use App\Models\ServiceOrder;
use App\Models\Webhook;
use App\Observers\ServiceOrderObserver;
use App\Observers\WebhookObserver;
use Illuminate\Support\ServiceProvider;

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
        // ServiceOrder::observe(ServiceOrderObserver::class);
        Webhook::observe( WebhookObserver::class);
    }
}
