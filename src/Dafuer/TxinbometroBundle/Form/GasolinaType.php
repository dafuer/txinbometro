<?php

namespace Dafuer\TxinbometroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GasolinaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('km')
                ->add('fecha', 'text',array('required'=>true,)) //, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd hh:mm:ss'))
                ->add('litros')
                ->add('coste')
                ->add('tipo', 'choice', array('choices' => array('carretera' => 'Carretera', 'mixto' => 'Mixto', 'urbano' => 'Urbano')))
                ->add('gasolinera')
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
        return 'ds_txinbometrobundle_gasolinatype';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dafuer\TxinbometroBundle\Entity\Gasolina',
        ));
    }    

}
