<?php
namespace Artem328\LaravelYandexKassa\Exceptions;

use Exception;

class YandexKassaNoPaymentTypesProvidedException extends Exception
{
    /**
     * YandexKassaNoPaymentTypesProvidedException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct('No payment types have been provided', $code, $previous);
    }

}