<?php

namespace Gwyath\Bundle\AdventureBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;

class PageCreatorResponseCollectionException extends HttpException
{

    const PCRC_NOT_ARRAY = 'The given collection of responses is not an array';
    const PCRC_INTEGRITY_ISSUE = 'All of the given responses are not of the correct type';

    public function __construct($message = null, Exception $previous = null, $code = 0)
    {
        parent::__construct(422, $message, $previous, array(), $code);
    }
}