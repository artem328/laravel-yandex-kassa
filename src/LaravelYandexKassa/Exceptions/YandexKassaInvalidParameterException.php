<?php
namespace Artem328\LaravelYandexKassa\Exceptions;

use Exception;

class YandexKassaInvalidParameterException extends Exception {
    /**
     * YandexKassaInvalidParameterException constructor.
     * @param string $parameter
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($parameter = '', $code = 0, Exception $previous = null)
    {
        $message = 'Invalid' . ($parameter ? ' ' . $parameter : '') . ' parameter';

        parent::__construct($message, $code, $previous);
    }

}