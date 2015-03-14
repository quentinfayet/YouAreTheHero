<?php

namespace Gwyath\Bundle\AdventureBundle\Flashbag;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class NewAdventureFlashbag extends FlashBag
{

    public static function sendSuccess()
    {
        self::add('newAdventureSuccess',
            'The adventure has been created');
    }

    public static function sendError()
    {
        self::add('newAdventureError',
            'An error occured during the creation of the adventure');
    }
}