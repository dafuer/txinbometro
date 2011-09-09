<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

//use JpGraph;

class EstadisticasController extends Controller {

    /**
     * 
     * @Template()
     */
    public function generalAction() {
        $vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();

        $em = $this->getDoctrine()->getEntityManager();

        //$entities = $em->getRepository('TxinbometroBundle:Gasolina')->getConsumos($vehiculo);

    
        return array();
    }
    
    


}
