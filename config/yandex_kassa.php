<?php

return [
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
    'shop_password' => ''
];