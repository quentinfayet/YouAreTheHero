<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;

class ResponseException extends HttpException
{

    const RESPONSE_BAD_TYPE = 'The response is not of %s type';
    const RESPONSE_UNKNOWN_STATUS = 'The status set nit the %s response is not known';

    public function __construct($message = null, $responseType = null, Exception $previous = null, $code = 0)
    {
        if (null === $responseType) {
            $responseType = '(unknown)';
        }
        $message = sprintf($message, $responseType);
        parent::__construct(422, $message, $previous, array(), $code);
    }
}