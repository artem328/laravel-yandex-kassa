<?php

namespace Artem328\LaravelYandexKassa;

class YandexKassa
{
    /**
     * Payment form submit url
     *
     * @var string
     */
    private $formAction = 'https://money.yandex.ru/eshop.xml';

    /**
     * Payment form submit url for test payments
     *
     * @var string
     */
    private $testFormAction = 'https://demomoney.yandex.ru/eshop.xml';

    /**
     * Get form action url
     *
     * @return string
     */
    public function getFormAction()
    {
        return config('yandex_kassa.test_mode', true) ? $this->testFormAction : $this->formAction;
    }
}