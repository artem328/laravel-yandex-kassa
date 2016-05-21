<?php
namespace Artem328\LaravelYandexKassa;

use Artem328\LaravelYandexKassa\Events\BeforeCancelOrderResponse;
use Artem328\LaravelYandexKassa\Events\BeforeCheckOrderResponse;
use Artem328\LaravelYandexKassa\Events\BeforePaymentAvisoResponse;
use Artem328\LaravelYandexKassa\Requests\YandexKassaRequest;
use Illuminate\Routing\Controller;

class YandexKassaController extends Controller
{
    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function checkOrder(YandexKassaRequest $request)
    {
        $responseParameters = $this->getDefaultResponseParameters($request);
    
        /*
         * Before send response, passing request and response parameters
         * through listeners
         */
        return $this->getXmlResponse('checkOrderResponse', $this->mergerResponseParameters(
            $responseParameters,
            event(new BeforeCheckOrderResponse($request, $responseParameters))
        ));
    }

    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cancelOrder(YandexKassaRequest $request)
    {
        $responseParameters = $this->getDefaultResponseParameters($request);
        
        /*
         * Before send response, passing request and response parameters
         * through listeners
         */
        return $this->getXmlResponse('cancelOrderResponse', $this->mergerResponseParameters(
            $responseParameters,
            event(new BeforeCancelOrderResponse($request, $responseParameters))
        ));
    }

    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function paymentAviso(YandexKassaRequest $request)
    {
        $responseParameters = $this->getDefaultResponseParameters($request);

        /*
         * Before send response, passing request and response parameters
         * through listeners
         */
        return $this->getXmlResponse('paymentAvisoResponse', $this->mergerResponseParameters(
            $responseParameters,
            event(new BeforePaymentAvisoResponse($request, $responseParameters))
        ));
    }

    /**
     *
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return array
     */
    protected function getDefaultResponseParameters(YandexKassaRequest $request)
    {
        return [
            'performedDatetime' => $request->get('requestDatetime'),
            'code' => $request->isValidHash() ? 0 : 1,
            'invoiceId' => $request->get('invoiceId'),
            'shopId' => yandex_kassa_shop_id()
        ];
    }

    /**
     * Merge response parameters after events processing
     *
     * @param array $responseParameters
     * @param array $responses
     * @return array
     */
    protected function mergerResponseParameters($responseParameters, $responses)
    {
        foreach ($responses as $response) {
            if (! is_array($response)) {
                continue;
            }
            $responseParameters = array_merge($responseParameters, $response);
        }

        return $responseParameters;
    }

    /**
     * Generates XML output
     *
     * @param string $tagName
     * @param array $parameters
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    protected function getXmlResponse($tagName, $parameters)
    {
        $response = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<',
            $tagName,
            $this->getXmlAttributes($parameters),
            '/>'
        ];

        return response(implode('', $response), 200, [
            'Content-type' => 'application/xml'
        ]);
    }

    /**
     * Generates xml attributes string from array
     *
     * @param $parameters
     * @return string
     */
    protected function getXmlAttributes($parameters)
    {
        $attributes = [];

        foreach ($parameters as $name => $value) {
            if (is_string($name)) {
                $attributes[] = htmlspecialchars($name, ENT_XML1) . '="' . htmlspecialchars($value, ENT_XML1) . '"';
            }
        }

        return !empty($attributes) ? ' ' . implode(' ', $attributes) : '';
    }
}