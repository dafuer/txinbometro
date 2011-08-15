<?php

namespace DS\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GasolinaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('km')
            ->add('fecha')
            ->add('litros')
            ->add('coste')
            ->add('tipo')
            ->add('gasolinera')
            ->add('comentario')
        ;
    }

    public function getName()
    {
        return 'ds_txinbometrobundle_gasolinatype';
    }
}
