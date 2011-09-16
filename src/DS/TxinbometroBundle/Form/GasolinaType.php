<?php

namespace DS\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GasolinaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('km')
            ->add('fecha')
            ->add('litros')
            ->add('coste')
            ->add('tipo')
            ->add('gasolinera')
            ->add('comentario',null,array('attr' => array('class' => 'tinymce' ))) //,'tinymce'=>'{"theme":"simple"}')))
        ;
    }

    public function getName()
    {
        return 'ds_txinbometrobundle_gasolinatype';
    }
}
