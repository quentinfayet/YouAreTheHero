<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;


class GwyathController extends Controller
{
    /** @var EntityManager */
    protected $em;

    public function preExecute()
    {
        $this->em = $this->getDoctrine()->getManager();
    }
}