<?php

namespace Gwyath\Bundle\AdventureBundle\Service;

use Gwyath\Bundle\AdventureBundle\Entity\Page;
use Gwyath\Bundle\AdventureBundle\Exception\PageException;
use Symfony\Component\Form\Form;
use \Exception;

class PageCreator
{
    /**
     * Generates a page
     * @param Form $form
     * @param Page $page
     */
    public function createPage(Form $form, Page $page)
    {
        try {
            $this->checkCreatePageArguments($form, $page);

        } catch (Exception $e) {
            if ($e instanceof PageException) {
                //TODO Render specific template
            } else {
                // TODO Render specific template
            }
        }
    }

    /**
     * Checks weither the arguments givent to createPage method are valid or not.
     * @param Form $form
     * @param Page $page
     */
    private function checkCreatePageArguments(Form $form, Page $page)
    {
        if (!$form->isValid()) {
            throw new PageException(PageException::PAGE_INVALID_FORM);
        }
        if (empty($page)) {
            throw new PageException(PageException::PAGE_ENTITY_IS_INVALID);
        }
    }
}