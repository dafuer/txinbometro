<?php

namespace DS\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VehiculoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('tipo')
            ->add('marca')
            ->add('modelo')
            ->add('compra')
            ->add('coste')
            ->add('km_iniciales')
            ->add('capacidad')
            //->add('usuario')
        ;
    }

    public function getName()
    {
        return 'ds_txinbometrobundle_vehiculotype';
    }
}