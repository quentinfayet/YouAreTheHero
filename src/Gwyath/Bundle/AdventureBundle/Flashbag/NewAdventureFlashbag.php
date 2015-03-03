<?php

namespace Gwyath\Bundle\AdventureBundle\Flashbag;

class NewAdventureFlashbag
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