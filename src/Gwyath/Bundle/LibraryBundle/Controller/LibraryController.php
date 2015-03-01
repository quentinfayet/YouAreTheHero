<?php

namespace Gwyath\Bundle\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LibraryController extends Controller
{
    /**
     * @Route("/", name="_dashboard")
     * @Template()
     */
    public function indexAction()
    {
        $additionalInfos = array(
            'breadcrumb' => array(
                array(
                    'title' => 'Homepage',
                    'icon' => 'fa fa-home',
                    'route' => false
                )
            ),
            'title' => 'Dashboard');

        return array_merge($additionalInfos, array(
        ));
    }
}
