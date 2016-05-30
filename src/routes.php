<?php

app('router')->group([
   'namespace' => 'Artem328\LaravelYandexKassa'
], function () {

    /** @var \Illuminate\Routing\Router $router */
    $router = app('router');

    $router->post(
        config('yandex_kassa.route.checkOrder.url'),
        yandex_kassa_route_action('YandexKassaController@checkOrder', config('yandex_kassa.route.checkOrder.action', []))
    );

    $router->post(
        config('yandex_kassa.route.cancelOrder.url'),
        yandex_kassa_route_action('YandexKassaController@cancelOrder', config('yandex_kassa.route.checkOrder.action', []))
    );

    $router->post(
        config('yandex_kassa.route.paymentAviso.url'),
        yandex_kassa_route_action('YandexKassaController@paymentAviso', config('yandex_kassa.route.paymentAviso.action', []))
    );
});