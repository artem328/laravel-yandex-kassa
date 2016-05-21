<?php

/**
 * Helper function for generating route parameters
 * of Yandex Kassa
 * 
 * @param array $actions
 * @param string $uses
 * @param string $namespace
 * @param array $defaults
 * @return array
 */
function yandex_kassa_route_action($uses, $actions = [], $namespace = '', $defaults = []) {
    return array_merge(
        $actions,
        [
            'uses' => $uses,
            'namespace' => $namespace
        ],
        $defaults
    );
}

/**
 * Helper function for getting YandexKassa
 * class instance
 *
 * @return \Artem328\LaravelYandexKassa\YandexKassa
 */
function yandex_kassa() {
    return app('yandexkassa');
}

/**
 * Helper function for getting form action
 *
 * @return string
 */
function yandex_kassa_form_action()
{
    return yandex_kassa()->getFormAction();
}

/**
 * Helper function for getting form method
 *
 * @return string
 */
function yandex_kassa_form_method()
{
    return yandex_kassa()->getFormMethod();
}

/**
 * Helper function for getting scId parameter
 *
 * @return string
 * @throws \Artem328\LaravelYandexKassa\Exceptions\YandexKassaInvalidParameterException
 */
function yandex_kassa_sc_id()
{
    return yandex_kassa()->getScId();
}

/**
 * Helper function for getting shopId parameter
 *
 * @return string
 * @throws \Artem328\LaravelYandexKassa\Exceptions\YandexKassaInvalidParameterException
 */
function yandex_kassa_shop_id()
{
    return yandex_kassa()->getShopId();
}

/**
 * Helper function for getting payment types
 *
 * @return \Illuminate\Support\Collection
 * @throws \Artem328\LaravelYandexKassa\Exceptions\YandexKassaNoPaymentTypesProvidedException
 */
function yandex_kassa_payment_types()
{
    return yandex_kassa()->getPaymentTypes();
}