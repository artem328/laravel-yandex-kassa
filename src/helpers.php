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
    return \Illuminate\Foundation\Application::getInstance()->make('yandexkassa');
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