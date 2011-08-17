<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * 
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Template()
     */
    public function menuAction($opcion, $subopcion){
        return array('opcion'=>$opcion, 'subopcion'=>$subopcion);
    }
    
    
}
