<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Test Mode
    | Режим тестирования
    |--------------------------------------------------------------------------
    |
    | After process test payment and confirm it by Yandex
    | Kassa, you must set this option value as false
    |
    | После проведения тестового платежа и подтверждения
    | этого платежа Яндекс Кассой, необходимо установить
    | значение этой опции в false
    |
    */
    'test_mode' => true,

    /*
    |--------------------------------------------------------------------------
    | Yandex Money shop parameters
    | Параметры магазина Яндекс Деньги
    |--------------------------------------------------------------------------
    |
    | In this section you should write yandex money requisites,
    | that you can get on Yandex Kassa official website, after
    | registering own shop
    |
    | Параметры, которые нужно заполнить ниже можно получить
    | в личном кабинете Яндекс Кассы, после регистрации
    | магазина
    |
    | @see https://money.yandex.ru/joinups
    |
    */
    'shop_id' => null,
    'sc_id' => null,

    /*
    |--------------------------------------------------------------------------
    | Shop Password
    | Секретное слово магазина (shoppassword)
    |--------------------------------------------------------------------------
    |
    | Secret word for generating md5-hash
    |
    | Секретное слово для формирования md5-хэша
    |
    | @see https://tech.yandex.ru/money/doc/payment-solution/shop-config/parameters-docpage/
    |
    */
    'shop_password' => '',

    /*
    |--------------------------------------------------------------------------
    | Routes settings
    | Настройки путей
    |--------------------------------------------------------------------------
    |
    */
    'route' => [
        'paymentAviso' => [
            'url' => '/yandex_kassa/paymentAviso',
            'action' => []
        ]
    ]
];
