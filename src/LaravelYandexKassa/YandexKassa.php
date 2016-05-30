<?php

namespace Artem328\LaravelYandexKassa;

use Artem328\LaravelYandexKassa\Exceptions\YandexKassaInvalidParameterException;
use Artem328\LaravelYandexKassa\Exceptions\YandexKassaNoPaymentTypesProvidedException;

class YandexKassa
{
    /**
     * Current version of Laravel Yandex Kassa
     */
    const VERSION = '1.0.0';

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
     * Payment form submit method
     *
     * @var string
     */
    private $formMethod = 'POST';

    /**
     * Collection with available payment types
     *
     * @var \Illuminate\Support\Collection
     */
    protected $paymentTypes;

    /**
     * Get current version of package
     *
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Get form action url
     *
     * @return string
     */
    public function getFormAction()
    {
        return config('yandex_kassa.test_mode', true) ? $this->testFormAction : $this->formAction;
    }

    /**
     * Get form method
     * 
     * @return string
     */
    public function getFormMethod()
    {
        return $this->formMethod;
    }

    /**
     * Get scId parameter
     *
     * @return string
     * @throws \Artem328\LaravelYandexKassa\Exceptions\YandexKassaInvalidParameterException
     */
    public function getScId()
    {
        $scId = config('yandex_kassa.sc_id');

        if (!$scId) {
            throw new YandexKassaInvalidParameterException('scId');
        }

        return $scId;
    }

    /**
     * Get shopId parameter
     *
     * @return string
     * @throws \Artem328\LaravelYandexKassa\Exceptions\YandexKassaInvalidParameterException
     */
    public function getShopId()
    {
        $shopId = config('yandex_kassa.shop_id');

        if (!$shopId) {
            throw new YandexKassaInvalidParameterException('shopId');
        }

        return $shopId;
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Artem328\LaravelYandexKassa\Exceptions\YandexKassaNoPaymentTypesProvidedException
     */
    public function getPaymentTypes()
    {
        if ($this->paymentTypes === null)
            $this->paymentTypes = collect(config('yandex_kassa.payment_types', []));

        if ($this->paymentTypes->isEmpty()) {
            throw new YandexKassaNoPaymentTypesProvidedException;
        }

        return $this->paymentTypes;
    }
}