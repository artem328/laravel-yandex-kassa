<?php

namespace Artem328\LaravelYandexKassa;

use Illuminate\Support\ServiceProvider;

class YandexKassaServiceProvider extends ServiceProvider
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

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'yandex_kassa');

        $this->publishes([
            __DIR__ . '/../config/yandex_kassa.php' => config_path('payment_types.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/../lang' => resource_path('lang/vendor/yandex_kassa')
        ], 'lang');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/yandex_kassa.php', 'yandex_kassa');

        $this->app->singleton('yandexkassa', function() {
            return new YandexKassa();
        });
    }
}