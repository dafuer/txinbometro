<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DS\TxinbometroBundle\Graph;

class GraficosController extends Controller
{
    

    public function graphAction() {   
        $request = $this->get('request');

        $dataaccess=new Graph\DataSerie($this->get('session'), $this->getDoctrine()->getEntityManager());
        
        return $this->forward('DafuerJpgraphBundle:Graph:query', array('request' => $request, 'dataaccess' => $dataaccess)); 
    }
    
}
