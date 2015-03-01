<?php

namespace Gwyath\Bundle\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GameController extends Controller
{
    /**
     * @Route("/new-game", name="_newGame")
     * @Template()
     */
    public function newGameAction()
    {
        $additionalInfos = array(
            'breadcrumb' => array(
                array(
                    'title' => 'Homepage',
                    'icon' => 'fa fa-home',
                    'route' => false
                ),
                array(
                    'title' => 'New Game',
                    'icon' => null,
                    'route' => '_newGame'
                )
            ),
            'title' => 'Dashboard');

        return array_merge($additionalInfos, array(
        ));
    }
}
