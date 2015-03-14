<?php

use Symfony\Component\Form\Test\TypeTestCase;
use Gwyath\Bundle\AdventureBundle\Form\Type\NewPageType;
use Symfony\Component\Form\FormInterface;
use Gwyath\Bundle\AdventureBundle\Entity\PageType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Forms;

class PageCreatorFormTest extends TypeTestCase
{

    // TODO Debug this test
    /*protected function setUp()
    {
        parent::setUp();

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->getFormFactory();
    }

    protected function getExtensions()
    {
        $mockEntityManager = $this->getMockBuilder('\Doctrine\ORM\EntityManager')->getMock();

        $mockRegistry = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
            ->disableOriginalConstructor()
            ->setMethods(array('getManagerForClass'))
            ->getMock();

        $mockRegistry->expects($this->any())->method('getManagerForClass')
            ->will($this->returnValue($mockEntityManager));

        $mockEntityType = $this->getMockBuilder('Gwyath\Bundle\AdventureBundle\Form\Type\NewPageType')
            ->disableOriginalConstructor()
            ->getMock();

        $mockEntityType->expects($this->any())->method('getName')
            ->will($this->returnValue('entity'));

        return array(new PreloadedExtension(array(
            $mockEntityType->getName() => $mockEntityType,
        ), array()));
    }
    
    public function testPageCreatorThrowExceptionOnInvalidForm()
    {
        $newPageType = new NewPageType();

        $form = $this->factory->create($newPageType);

    }*/
}