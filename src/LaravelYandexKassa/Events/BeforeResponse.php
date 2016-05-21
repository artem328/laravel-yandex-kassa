<?php

namespace Artem328\LaravelYandexKassa\Events;

use Artem328\LaravelYandexKassa\Requests\YandexKassaRequest;

class BeforeResponse extends YandexKassaEvent
{
    /**
     * @var \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest
     */
    public $request;

    /**
     * @var array
     */
    public $responseParameters;

    /**
     * BeforeResponse constructor.
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @param array $responseParameters
     */
    public function __construct(YandexKassaRequest $request, $responseParameters)
    {
        $this->request = $request;
        $this->responseParameters = $responseParameters;
    }
}