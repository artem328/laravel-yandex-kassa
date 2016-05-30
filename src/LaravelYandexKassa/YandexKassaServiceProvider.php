<?php

namespace Artem328\LaravelYandexKassa;

use Artem328\LaravelYandexKassa\Requests\YandexKassaRequest;
use Artem328\LaravelYandexKassa\Responses\YandexKassaResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
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
        $this->bootRoutes();
        $this->bootTranslations();
        $this->bootViews();

        $this->bootPublishes();

        $this->bootResponse();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigs();

        $this->registerSingleton();
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

    /**
     * @return void
     */
    protected function bootRoutes()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../routes.php';
        }
    }

    /**
     * @return void
     */
    protected function bootTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'yandex_kassa');
    }

    /**
     * @return void
     */
    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'yandex_kassa');
    }

    /**
     * @return void
     */
    protected function bootPublishes()
    {
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
     * @return void
     */
    protected function bootResponse()
    {
        app(ResponseFactory::class)->macro('yandexKassaResponse', function (YandexKassaRequest $request, $type){
           return new YandexKassaResponse($request, $type);
        });
    }

    /**
     * @return void
     */
    protected function registerConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/yandex_kassa.php', 'yandex_kassa');
    }

    protected function registerSingleton()
    {
        $this->app->singleton('yandexkassa', function() {
            return new YandexKassa();
        });
    }
    
}