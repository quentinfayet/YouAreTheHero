<?php

namespace Gwyath\Bundle\AdventureBundle\Service\Response;

class PageCreatorResponse
{

    const ALREADY_HAS_BEGINNING = 'This adventure already has a beginning page';

    const UNKNOWN_ERROR = 'An unknown error has occured ; However, the workflow of page creation seems to be complete';

    const ERROR = -1;
    const SUCCESS = 0;
    const WARNING = 1;

    /** @var int */
    private $status;
    /** @var string */
    private $message;

    /**
     * Constructor
     * @param int $status
     * @param null $message
     */
    public function __construct($status = self::ERROR, $message = null)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


}