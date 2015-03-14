<?php

namespace Gwyath\Bundle\AdventureBundle\Service;

use Doctrine\ORM\EntityManager;
use Gwyath\Bundle\AdventureBundle\Entity\Page;
use Gwyath\Bundle\AdventureBundle\Entity\PageType;
use Gwyath\Bundle\AdventureBundle\Service\Response\PageCreatorResponseCollection;
use Gwyath\Bundle\AdventureBundle\Exception\PageException;
use Symfony\Component\Form\Form;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;
use \Exception;
use Gwyath\Bundle\AdventureBundle\Entity\PageRepository;
use Gwyath\Bundle\AdventureBundle\Entity\AdventureRepository;
use Gwyath\Bundle\AdventureBundle\Service\Response\PageCreatorResponse;

class PageCreator
{

    /** @var EntityManager */
    private $em;
    /** @var PageRepository */
    private $pageRepository;
    /** @var  AdventureRepository */
    private $adventureRepository;

    /**
     * Constructor
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->pageRepository = $em->getRepository('GwyathAdventureBundle:Page');
        $this->adventureRepository = $em->getRepository('GwyathAdventureBundle:Adventure');
    }

    /**
     * Generates a page
     * @param Form $form
     * @param Page $page
     * @param Adventure $adventure
     * @return PageCreatorResponse
     */
    public function createPage(Form $form, Page $page, Adventure $adventure)
    {
        try {
            $this->checkCreatePageArguments($form, $page, $adventure);
            if ($page->getPageType()->getName() == PageType::BEGINNING_NAME) {
                if ($this->checkIfNoBeginningPage($adventure)) {
                    return new PageCreatorResponse(PageCreatorResponse::ERROR, PageCreatorResponse::ALREADY_HAS_BEGINNING);
                }
                if (true != ($integrityReponse = $this->checkPageIntegrity($page))) {
                    /** @var PageCreatorResponseCollection $pageResponseCollection */
                    $pageResponseCollection = new PageCreatorResponseCollection($integrityReponse);
                    if ($pageResponseCollection->hasErrors()) {
                        return $pageResponseCollection;
                    }
                }
                $page->setAdventure($adventure);
                $this->em->persist($page);
                $this->em->flush();
                if (isset($pageResponseCollection)) {
                    $pageResponseCollection->addReponse(new PageCreatorResponse(PageCreatorResponse::SUCCESS));
                    return $pageResponseCollection;
                }
                return new PageCreatorResponse(PageCreatorResponse::SUCCESS);
            }
            return new PageCreatorResponse(PageCreatorResponse::ERROR, PageCreatorResponse::UNKNOWN_ERROR);
        } catch (Exception $e) {
            if ($e instanceof PageException) {
                return new PageCreatorResponse(PageCreatorResponse::ERROR, $e->getMessage());
            } else {
                echo ($e->getTraceAsString());
                return new PageCreatorResponse(PageCreatorResponse::ERROR, $e->getMessage());
            }
        }
    }

    private function checkPageIntegrity(Page $page)
    {
        /** @var array $response */
        $responses = array();

        if (null === $page->getPageType()) {
            $responses[] = new PageCreatorResponse(PageCreatorResponse::WARNING, 'The page has not type. Type has been defined to "Normal"');
        }
        /** @var string $text */
        $text = $page->getText();
        if (empty($text)) {
            $responses[] = new PageCreatorResponse(PageCreatorResponse::ERROR, 'There is no text on this page');
        }

        if (empty($responses)) {
            return true;
        }
        return $responses;
    }

    /**
     * Checks whether the arguments givent to createPage method are valid or not.
     * @param Form $form
     * @param Page $page
     * @param Adventure $adventure
     */
    private function checkCreatePageArguments(Form $form, Page $page, Adventure $adventure)
    {
        if (empty($form)) {
            throw new PageException(PageException::PAGE_INVALID_FORM);
        }
        if (empty($page)) {
            throw new PageException(PageException::PAGE_INVALID_PAGE_ENTITY);
        }
        if (empty($adventure)) {
            throw new PageException(PageException::PAGE_INVALID_ADVENTURE_ENTITY);
        }
    }

    /**
     * Checks whether the current adventure already has a beginning page
     * @param Adventure $adventure
     * @return boolean
     */
    private function checkIfNoBeginningPage(Adventure $adventure)
    {
        if (0 == intval($this->adventureRepository->hasBeginningPage($adventure))) {
            return false;
        }
        return true;
    }
}