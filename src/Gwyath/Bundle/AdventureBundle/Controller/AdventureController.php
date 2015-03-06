<?php

namespace Gwyath\Bundle\AdventureBundle\Controller;

use AppBundle\Controller\GwyathController;
use Gwyath\Bundle\AdventureBundle\Flashbag\NewAdventureFlashbag;
use Gwyath\Bundle\AdventureBundle\Form\Type\NewAdventureType;
use Gwyath\Bundle\AdventureBundle\Form\Type\NewPageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Gwyath\Bundle\AdventureBundle\Entity\AdventureRepository;
use Gwyath\Bundle\AdventureBundle\Exception\AdventureException;
use Gwyath\Bundle\AdventureBundle\Entity\Page;

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
                'form' => $form->createView()
            ));
        } catch (AdventureException $e) {
            // TODO Render custom template for exceptions
            var_dump($e->getMessage());
        }
    }
}
