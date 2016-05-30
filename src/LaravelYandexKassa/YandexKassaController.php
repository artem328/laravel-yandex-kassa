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
        /** @var \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse $response */
        $response = response()->yandexKassaResponse($request, 'checkOrder');

        /*
         * Before send response, passing request and response
         * through listeners
         */
        event(new BeforeCheckOrderResponse($request, $response));

        return $response->prepare();
    }

    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cancelOrder(YandexKassaRequest $request)
    {
        /** @var \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse $response */
        $response = response()->yandexKassaResponse($request, 'cancelOrder');

        /*
         * Before send response, passing request and response
         * through listeners
         */
        event(new BeforeCancelOrderResponse($request, $response));

        return $response->prepare();
    }

    /**
     * @param \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function paymentAviso(YandexKassaRequest $request)
    {
        /** @var \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse $response */
        $response = response()->yandexKassaResponse($request, 'paymentAviso');

        /*
         * Before send response, passing request and response
         * through listeners
         */
        event(new BeforePaymentAvisoResponse($request, $response));

        return $response->prepare();
    }
}