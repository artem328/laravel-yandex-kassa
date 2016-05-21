<?php
namespace Artem328\LaravelYandexKassa;

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
        
        return $this->getXmlResponse('checkOrderResponse', $responseParameters);
    }

    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cancelOrder(YandexKassaRequest $request)
    {
        $responseParameters = $this->getDefaultResponseParameters($request);

        return $this->getXmlResponse('cancelOrderResponse', $responseParameters);
    }

    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function paymentAviso(YandexKassaRequest $request)
    {
        $responseParameters = $this->getDefaultResponseParameters($request);

        return $this->getXmlResponse('paymentAvisoResponse', $responseParameters);
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
            $attributes[] = htmlspecialchars($name, ENT_XML1) . '="' . htmlspecialchars($value, ENT_XML1) . '"';
        }

        return !empty($attributes) ? ' ' . implode(' ', $attributes) : '';
    }
}