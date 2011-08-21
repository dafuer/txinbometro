<?php

namespace DS\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GastoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('km')
            ->add('fecha')
            ->add('tipo')
            ->add('coste')
            ->add('comentario')
        ;
    }

    public function getName()
    {
        return 'ds_txinbometrobundle_gastotype';
    }
}
