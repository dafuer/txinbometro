<?php
namespace Dafuer\TxinbometroBundle\Twig\Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UtilsExtension extends \Twig_Extension
{
  public function getFilters()
    {
        return array(
            'round' => new \Twig_Filter_Method($this, 'round', array('is_safe' => array('html'))),       
        );   
    }

    public function round($text, $decimal) {       
            return round($text, $decimal);   
    }

    public function getName()   
    {       
        return 'utils_extensions';   
    }    
    
    
    
}