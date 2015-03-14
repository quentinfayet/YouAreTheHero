<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;

class ServiceException extends HttpException
{

    const SERVICE_NULL = 'The service %s cannot be found';

    public function __construct($message = null, Exception $previous = null, $code = 0, $service = null)
    {
        if (null === $service) {
            $service = '(unknown)';
        }
        $message = sprintf($message, $service);
        parent::__construct(422, $message, $previous, array(), $code);
    }
}