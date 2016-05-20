<?php

namespace Artem328\LaravelYandexKassa;

use Illuminate\Support\ServiceProvider;

class LaravelYandexKassaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__ . '/../helpers.php';

        /** @noinspection PhpUndefinedMethodInspection */
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../routes.php';
        }

        $this->publishes([
            __DIR__ . '/../config/yandex_kassa.php' => config_path('yandex_kassa.php')
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/yandex_kassa.php', 'yandex_kassa');
    }
}