<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class GwyathController extends Controller
{
    /** @var EntityManager */
    protected $em;

    /** @var  Session */
    protected $session;

    public function preExecute()
    {
        $this->em = $this->getDoctrine()->getManager();
        $this->session = $this->get('session');
    }
}