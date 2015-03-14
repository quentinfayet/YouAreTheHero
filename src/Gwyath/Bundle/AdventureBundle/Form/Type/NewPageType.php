<?php

namespace Gwyath\Bundle\AdventureBundle\Form\Type;

use Gwyath\Bundle\AdventureBundle\Exception\AdventureException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;
use \Exception;

class NewPageType extends AbstractType
{

    const NAME = 'newPage';

    public function buildForm(FormBuilderInterface $builder, array $options, Adventure $adventure = null)
    {
        $builder->add('pageType', 'entity', array(
            'class' => 'GwyathAdventureBundle:PageType',
            'property' => 'name',
            'expanded' => true,
            'multiple' => false
        ));
        $builder->add('text');
        $builder->add('save', 'submit');
    }

    public function getName()
    {
        return self::NAME;
    }
}
