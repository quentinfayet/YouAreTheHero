<?php

namespace Gwyath\Bundle\AdventureBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;

class PageException extends HttpException
{

    const PAGE_INVALID_FORM = 'The form data are not valid';
    const PAGE_INVALID_PAGE_ENTITY = 'The given Page is not valid';
    const PAGE_INVALID_ADVENTURE_ENTITY = 'The given Adventure is not valid';

    public function __construct($message = null, Exception $previous = null, $code = 0)
    {
        parent::__construct(422, $message, $previous, array(), $code);
    }
}