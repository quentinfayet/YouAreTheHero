<?php

namespace Gwyath\Bundle\AdventureBundle\Controller;

use AppBundle\Controller\GwyathController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;

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
        $form = $this->createForm('newAdventure', $adventure);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $adventure->setAuthor($this->getUser());

            $this->em->persist($adventure);
            $this->em->flush();
            $this->em->clear();
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
}
