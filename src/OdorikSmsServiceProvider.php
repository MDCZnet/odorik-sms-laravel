<?php

namespace Odorik\Sms;

use Illuminate\Support\ServiceProvider;

class OdorikSmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/odorik.php', 'odorik');

        $this->app->singleton(OdorikSmsService::class, function ($app) {
            return new OdorikSmsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/odorik.php' => config_path('odorik.php'),
        ], 'config');
    }
}