<?php

/**
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