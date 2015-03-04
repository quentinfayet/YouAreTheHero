<?php

namespace Gwyath\Bundle\AdventureBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text');
        $builder->add('save', 'submit');
    }

    public function getName()
    {
        return 'newPage';
    }
}
