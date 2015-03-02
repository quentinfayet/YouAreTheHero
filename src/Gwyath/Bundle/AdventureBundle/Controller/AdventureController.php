<?php

namespace Gwyath\Bundle\AdventureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdventureController extends Controller
{
    /**
     * @Route("/new-adventure", name="_newAdventure")
     * @Template()
     */
    public function newAdventureAction()
    {
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
            'title' => 'Dashboard');

        return array_merge($additionalInfos, array(
        ));
    }
}
