<?php

namespace Gwyath\Bundle\AdventureBundle\Service\Response;

use Gwyath\Bundle\AdventureBundle\Exception\PageCreatorResponseCollectionException;

class PageCreatorResponseCollection
{
    /** @var array */
    private $responses;

    /**
     * Constructor
     * @param $responses array
     */
    public function __construct($responses)
    {
        if (!is_array($responses)) {
            throw new PageCreatorResponseCollectionException(PageCreatorResponseCollectionException::PCRC_NOT_ARRAY);
        }
        foreach ($responses as $response) {
            if (!($response instanceof PageCreatorResponse)) {
                throw new PageCreatorResponseCollectionException(PageCreatorResponseCollectionException::PCRC_INTEGRITY_ISSUE);
            }
        }
        $this->responses = $responses;
    }

    /**
     * Checks whether the collection contains a response with error status
     * @return bool
     */
    public function hasErrors()
    {
        if (empty($this->responses))
            return false;
        /** @var PageCreatorResponse $response */
        foreach ($this->responses as $response) {
            if ($response->getStatus() == PageCreatorResponse::ERROR)
                return true;
        }
        return false;
    }

    /**
     * Adds a response to the collection
     * @param PageCreatorResponse $response
     * @return PageCreatorResponseCollection
     */
    public function addResponse(PageCreatorResponse $response)
    {
        $this->responses[] = $response;
        return $this;
    }

    /**
     * @return array
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param array $responses
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }


}