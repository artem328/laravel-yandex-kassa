<?php

namespace Artem328\LaravelYandexKassa\Events;

use Artem328\LaravelYandexKassa\Requests\YandexKassaRequest;
use Artem328\LaravelYandexKassa\Responses\YandexKassaResponse;

class BeforeResponse extends YandexKassaEvent
{
    /**
     * @var \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest
     */
    public $request;

    /**
     * @var \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse
     */
    public $response;

    /**
     * BeforeResponse constructor.
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @param \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse $response
     */
    public function __construct(YandexKassaRequest $request, YandexKassaResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}