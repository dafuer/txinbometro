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
        return array();
    }

    /**
     * 
     * @Template()
     */
    public function mensualAction() {
        return array();
    }

    /**
     * 
     * @Template()
     */
    public function economicasAction() {
        $resumenConsumo=$this->get('session')->get('resumenConsumo');

        $vehiculo=$this->get('session')->get('vehiculo');
        
        $costevehiculo=$vehiculo->getCoste();

        $costerevisiones=0;
        $costecomplementos=0;
        $costeseguros=0;
        $costerepuestos=0;
        $a='';
        

        $em = $this->getDoctrine()->getEntityManager();

        $lista_datos = $em->getRepository('TxinbometroBundle:Gasto')->getAllFrom($vehiculo->getId());
        
        $i=0;
        foreach($lista_datos as $dato) {
            if($dato->getTipo()=='revision') $costerevisiones+=$dato->getCoste();
            if($dato->getTipo()=='complemento') $costecomplementos+=$dato->getCoste();
            if($dato->getTipo()=='seguro') $costeseguros+=$dato->getCoste();
            if($dato->getTipo()=='repuesto') $costerepuestos+=$dato->getCoste();
        }

        $costeLitros=$resumenConsumo->getCosteLitros();

        $sumatotal=$costevehiculo+$costerevisiones+$costerepuestos+$costecomplementos+$costeseguros+$costeLitros['total'];        
        
        return array('costeVehiculo'=>$costevehiculo,
            'costeRevisiones'=>$costerevisiones,
            'costeComplementos'=>$costecomplementos,
            'costeSeguros'=>$costeseguros,
            'costeRepuestos'=>$costerepuestos,
            'costeLitros'=>$costeLitros['total'],
            'costeTotal'=>$sumatotal);
    }

}
