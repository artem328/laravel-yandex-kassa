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
    'test_mode' => env('YANDEX_KASSA_TEST_MODE', true),

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
    'shop_id' => env('YANDEX_KASSA_SHOP_ID', null),
    'sc_id' => env('YANDEX_KASSA_SC_ID', null),

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
    | @see https://tech.yandex.com/money/doc/payment-solution/shop-config/parameters-docpage/
    |
    */
    'shop_password' => env('YANDEX_KASSA_SHOP_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | Payment types
    | Способы оплаты
    |--------------------------------------------------------------------------
    |
    | Payment types that will be given in payment form.
    | All available payment types you can find
    | in Yandex Kassa documentation
    |
    | Способы оплаты, которые будут предложены в форме
    | оплаты. Все доступные способы оплаты можно найти
    | в документации Яндекс Кассы
    |
    | @see https://tech.yandex.com/money/doc/payment-solution/reference/payment-type-codes-docpage/
    |
    */
    'payment_types' => [
        'PC', 'AC', 'MC', 'GP',
        'WM', 'SB', 'MP', 'AB',
        'MA', 'PB', 'QW', 'KV',
        'QP'
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes settings
    | Настройки путей
    |--------------------------------------------------------------------------
    |
    */
    'route' => [
        'checkOrder' => [
            'url' => '/yandex_kassa/checkOrder',
            //'action' => [
            //    'middleware' => 'web'
            //]
        ],
        'cancelOrder' => [
            'url' => '/yandex_kassa/cancelOrder'
        ],
        'paymentAviso' => [
            'url' => '/yandex_kassa/paymentAviso',
        ]
    ],
];
