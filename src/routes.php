<?php

Route::group([
   'namespace' => 'Artem328\LaravelYandexKassa'
], function () {

    Route::post(
        config('yandex_kassa.route.paymentAviso.url'),
        yandex_kassa_route_action('YandexKassaController@test', config('yandex_kassa.route.paymentAviso.action', []))
    );
});