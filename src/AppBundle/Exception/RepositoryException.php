<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;

class RepositoryException extends HttpException
{

    const REPOSITORY_BAD_RESULT = 'The given result is not the expected one';

    public function __construct($message = null, Exception $previous = null, $code = 0)
    {
        parent::__construct(422, $message, $previous, array(), $code);
    }
}