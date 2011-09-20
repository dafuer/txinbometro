<?php

namespace DS\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VehiculoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('tipo','choice',array('choices'=>array('coche'=>'Coche','moto'=>'Moto')))
            ->add('marca')
            ->add('modelo')
            ->add('compra','date',array('widget' => 'single_text', 'format' => 'yyyy-MM-dd'))
            ->add('coste')
            ->add('km_iniciales')
            ->add('capacidad')
        ;
    }

    public function getName()
    {
        return 'ds_txinbometrobundle_vehiculotype';
    }
}