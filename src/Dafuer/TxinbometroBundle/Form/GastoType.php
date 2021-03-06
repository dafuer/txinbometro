<?php

namespace Dafuer\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GastoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('km')
                ->add('fecha', 'datetime', array('widget' => 'single_text', 'format' => 'yyyy-MM-dd HH:mm:00'))
                ->add('tipo', 'choice', array('choices' => 
                    array('revision' => 'Revision', 
                        'reparacion' => 'Reparacion', 
                        'repuesto' => 'Repuesto', 
                        'complemento' => 'Complemento', 
                        'seguro' => 'Seguro',
                        'documentacion' => 'Documentacion')))
                ->add('coste')
                ->add('comentario', 'textarea', array('attr' => array(
                                                        'class' => 'tinymce',
                                                        'data-theme' => 'medium' // simple, advanced, bbcode
                                                     )
                                                )
                      )                
                //->add('comentario', null, array('attr' => array('class' => 'tinymce'))) //,'tinymce'=>'{"theme":"simple"}')))
        ;
    }

    public function getName() {
        return 'ds_txinbometrobundle_gastotype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dafuer\TxinbometroBundle\Entity\Gasto',
        ));
    }

}
