<?php

namespace Gwyath\Bundle\AdventureBundle\Service;

use Gwyath\Bundle\AdventureBundle\Exception\PageException;
use Symfony\Component\Form\Form;
use \Exception;

class PageCreator
{
    public function createPage(Form $form)
    {
        try {
            if (!$form->isValid()) {
                throw new PageException(PageException::PAGE_INVALID_FORM);
            }
        } catch (Exception $e) {
            if ($e instanceof PageException) {
                //TODO Render specific template
            } else {
                // TODO Render specific template
            }
        }
    }
}