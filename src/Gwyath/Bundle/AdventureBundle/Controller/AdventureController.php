<?php

namespace Gwyath\Bundle\AdventureBundle\Controller;

use AppBundle\Controller\GwyathController;
use AppBundle\Exception\ResponseException;
use AppBundle\Exception\ServiceException;
use Gwyath\Bundle\AdventureBundle\Flashbag\NewAdventureFlashbag;
use Gwyath\Bundle\AdventureBundle\Form\Type\NewAdventureType;
use Gwyath\Bundle\AdventureBundle\Form\Type\NewPageType;
use Gwyath\Bundle\AdventureBundle\Service\Response\PageCreatorResponse;
use Gwyath\Bundle\AdventureBundle\Service\Response\PageCreatorResponseCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Gwyath\Bundle\AdventureBundle\Entity\AdventureRepository;
use Gwyath\Bundle\AdventureBundle\Exception\AdventureException;
use Gwyath\Bundle\AdventureBundle\Entity\Page;
use Gwyath\Bundle\AdventureBundle\Service\PageCreator;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class AdventureController extends GwyathController
{
    /**
     * @Route("/new-adventure", name="_newAdventure")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function newAdventureAction(Request $request)
    {
        /** @var Adventure $adventure */
        $adventure = new Adventure();
        /** @var Form $form */
        $form = $this->createForm(NewAdventureType::NAME, $adventure);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $adventure->setAuthor($this->getUser());

            $this->em->persist($adventure);
            $this->em->flush();
            $this->em->clear();

            $this->session->getFlashBag()->add('success', 'The adventure has been created');
        }

        $additionalInfos = array(
            'breadcrumb' => array(
                array(
                    'title' => 'Homepage',
                    'icon' => 'fa fa-home',
                    'route' => false
                ),
                array(
                    'title' => 'New Adventure',
                    'icon' => null,
                    'route' => '_newAdventure'
                )
            ),
            'title' => 'New Adventure');

        return array_merge($additionalInfos, array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/adventure/{adventureId}/new-page", name="_newPage")
     * @Template()
     * @param Request $request
     * @param integer $adventureId
     * @return array
     */
    public function newPageAction(Request $request, $adventureId)
    {
        try {
            if (!is_numeric($adventureId) || empty($adventureId)) {
                throw new AdventureException(AdventureException::ADVENTURE_BAD_ID);
            }

            /** @var AdventureRepository $adventureRepository */
            $adventureRepository = $this->em->getRepository('GwyathAdventureBundle:Adventure');
            /** @var Adventure $adventure */
            $adventure = $adventureRepository->findOneById($adventureId);

            if (null === $adventure) {
                throw new AdventureException(AdventureException::ADVENTURE_NOT_FOUND);
            }

            /** @var Page $page */
            $page = new Page();
            /** @var Form $form */
            $form = $this->createForm(NewPageType::NAME, $page);

            $form->handleRequest($request);

            if ($form->isValid()) {
                /** @var PageCreator $pageCreator */
                $pageCreator = $this->container->get('adventure.pageCreator');
                if (null === $pageCreator) {
                    throw new ServiceException(ServiceException::SERVICE_NULL, 'adventure.pageCreator');
                }
                $page->setAuthor($this->getUser());
                /** @var PageCreatorResponse $response */
                $response = $pageCreator->createPage($form, $page, $adventure);
                $this->handlePageCreatorReponse($response);
            }

            $additionalInfos = array(
                'breadcrumb' => array(
                    array(
                        'title' => 'Homepage',
                        'icon' => 'fa fa-home',
                        'route' => false
                    ),
                    array(
                        'title' => 'New Page for " <strong>' . $adventure->getName() . '</strong> "',
                        'icon' => null,
                        'route' => false
                    )
                ),
                'title' => 'Add a page to "' . $adventure->getName() . '"');

            return array_merge($additionalInfos, array(
                'form' => $form->createView(),
                'adventure' => $adventure
            ));
        } catch (AdventureException $e) {
            // TODO Render custom template for exceptions
            var_dump($e->getMessage());
        }
    }

    /**
     * Handles the response given by the PageCreator service ; Throw exceptions if needed, and creates flashbags.
     * @param PageCreatorResponse | PageCreatorResponseCollection $response
     */
    private function handlePageCreatorReponse($response)
    {
        if (!($response instanceof PageCreatorResponse) && !($response instanceof PageCreatorResponseCollection)) {
            throw new ResponseException(ResponseException::RESPONSE_BAD_TYPE, 'PageCreatorResponse || PageCreatorResponseCollection');
        } else {
            if ($response instanceof PageCreatorResponse) {
                $responses = array($response);
            } else {
                $responses = $response->getResponses();
            }
            /** @var FlashBag $flashBag */
            $flashBag = $this->session->getFlashBag();

            /** @var PageCreatorResponse $response */
            foreach ($responses as $response) {
                /** @var int $responseStatus */
                $responseStatus = $response->getStatus();

                if (PageCreatorResponse::ERROR === $responseStatus) {
                    $flashBag->add('error', $response->getMessage());
                } elseif (PageCreatorResponse::WARNING === $responseStatus) {
                    $flashBag->add('warning', $response->getMessage());
                } elseif (PageCreatorResponse::SUCCESS === $responseStatus) {
                    $flashBag->add('success', $response->getMessage());
                } else {
                    throw new ResponseException(ResponseException::RESPONSE_UNKNOWN_STATUS, 'PageCreatorResponse');
                }
            }
        }
    }
}
