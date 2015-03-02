<?php

namespace Gwyath\Bundle\AdventureBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewAdventureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add('save', 'submit');
    }

    public function getName()
    {
        return 'newAdventure';
    }
}