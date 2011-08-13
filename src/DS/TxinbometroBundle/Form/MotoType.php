<?php

namespace DS\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MotoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('marca')
            ->add('modelo')
            ->add('compra')
            ->add('coste')
            ->add('km_iniciales')
            ->add('capacidad')
            ->add('user')
        ;
    }

    public function getName()
    {
        return 'ds_txinbometrobundle_mototype';
    }
}
