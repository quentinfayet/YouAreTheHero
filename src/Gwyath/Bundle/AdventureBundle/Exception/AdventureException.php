<?php

namespace Gwyath\Bundle\AdventureBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;

class AdventureException extends HttpException
{

    const ADVENTURE_NOT_FOUND = 'The adventure cannot be found';
    const ADVENTURE_BAD_ID = 'The adventure ID is not correct';

    public function __construct($message = null, Exception $previous = null, $code = 0)
    {
        parent::__construct(422, $message, $previous, array(), $code);
    }
}