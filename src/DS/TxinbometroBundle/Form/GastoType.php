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
            ->add('fecha','date',array('widget' => 'single_text', 'format' => 'yyyy-MM-dd hh:mm:ss'))
            ->add('tipo','choice',array('choices'=>array('revision'=>'Revision', 'reparacion'=>'Reparacion', 'repuesto'=>'Repuesto', 'complemento'=>'Complemento','seguro'=>'Seguro')))
            ->add('coste')
            ->add('comentario',null,array('attr' => array('class' => 'tinymce' ))) //,'tinymce'=>'{"theme":"simple"}')))
        ;
    }


    public function getName()
    {
        return 'ds_txinbometrobundle_gastotype';
    }
}
