<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PropertyService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PropertyService::class, function ($app) {
            return new PropertyService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
