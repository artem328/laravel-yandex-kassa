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

        /** @noinspection PhpUndefinedMethodInspection */
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../routes.php';
        }

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'yandex_kassa');
        $this->loadViewsFrom(__DIR__ . '/../views', 'yandex_kassa');

        $this->publishes([
            __DIR__ . '/../config/yandex_kassa.php' => config_path('yandex_kassa.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/../lang' => resource_path('lang/vendor/yandex_kassa')
        ], 'lang');

        $this->publishes([
            __DIR__ . '/../views' => resource_path('views/vendor/yandex_kassa')
        ], 'view');
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'yandexkassa'
        ];
    }


}