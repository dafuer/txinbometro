<?php

namespace Dafuer\TxinbometroBundle\Graph;

use Dafuer\JpgraphBundle\Graph\BaseDataAccess;
use Dafuer\TxinbometroBundle\Entity;

class DataSerie extends BaseDataAccess {

    protected $session;
    protected $em;

    public function __construct($session,$em) {
        $this->graphindexpath = __DIR__ . "/DataSerie.yml";

        parent::__construct();
        
        $this->session=$session;
        $this->em=$em;
    }



    public function consumoGeneralKm($params) {
        $xdata=array();
        $ydata=array();
        $ydataacumulado=array();
        $consumoarea=array();
        
        $lista= $this->session->get('resumenConsumo')->getListado();
        
        // Creo los puntos
        for ($i=0;$i<count($lista);$i++) {
            $f[$i]=$lista[$i]['km'];
            //$xdata[$i]=strtotime($this->lista[$i]['fecha']);
            $xdata[$i]=$lista[$i]['km'];
            $ydata[$i]=$lista[$i]['consumo'];
          
            // Calculo el consumo acumulado
            if($i>0) $ydataacumulado[$i]=(($ydataacumulado[$i-1]*$i)+$lista[$i]['consumo'])/($i+1);
            else $ydataacumulado[$i]=$ydata[$i]=$lista[$i]['consumo'];
            
            // Preparo el area bajo cada consumo
            if($i>0){
                $color="white";
                switch($lista[$i]['tipo']) {
                    case 'carretera':
                        $color='#7dda7a@0.7';
                        break;
                    case 'mixto':
                        $color='#e8ea60@0.7';
                        break;
                    case 'urbano':
                        $color='#d86464@0.7';
                        break;
                } 
                $consumoarea[$i-1]['from']=$i-1;
                $consumoarea[$i-1]['to']=$i;
                $consumoarea[$i-1]['color']=$color;                
            }
            
        }
        
        $x=array();
        $yminimo=array();
        $ymaximo=array();
        
        $x[]=min($xdata);
        $x[]=max($xdata);
        $yminimo[0]=min($ydata);
        $yminimo[1]=$yminimo[0];
        $ymaximo[]=max($ydata);
        $ymaximo[1]=$ymaximo[0];
        
        return array('xdata'=>array('consumo'=>$xdata, 'minimo'=>$x, 'maximo'=>$x, 'acumulado'=>$xdata), 'ydata'=>array('consumo'=>$ydata, 'minimo'=>$yminimo, 'maximo'=>$ymaximo, 'acumulado'=>$ydataacumulado), 'custom'=>array('consumo'=>array('lineplot_area'=>$consumoarea)));
       
    }
    
  public function comparativaUso($params) {
        $km=$lista= $this->session->get('resumenConsumo')->getKm();
        
        $xdata=array('Urabano','Mixto','Carretera');        
        $ydata = array($km['urbano'], $km['mixto'],$km['carretera']);
  
//        $lbl = array($km['urbano']."km \n%.1f%%",$km['mixto']."km \n%.1f%%",$km['carretera']."km \n%.1f%%");

//        $pieplot->SetLabels($lbl);
//        $pieplot->SetLabelPos(1);
           
        return array( 'ydata'=>array( 'pie'=>$ydata) ); 
    }
    
      public function usoMensual($params) {
        $meses=$km=$lista= $this->session->get('resumenConsumo')->getMeses();

        $c=0;
        $f=array();
        $xdata=array();
        $ydata=array();

        $j=count($meses)-1;
        // Creo los puntos
        for ($i=0;$i<count($meses);$i++) {
            $f[$i]=$j;
            $xdata[$i]=$meses[$j]['fecha']['total'];
            $ydata[$i]=$meses[$i]['km_recorridos']['total'];

            $fc[$i]=$j;
            $xdatac[$i]=$meses[$j]['fecha']['carretera'];
            $ydatac[$i]=$meses[$i]['km_recorridos']['carretera'];

            $fu[$i]=$j;
            $xdatau[$i]=$meses[$j]['fecha']['mixto'];
            $ydatau[$i]=$meses[$i]['km_recorridos']['mixto'];

            $fm[$i]=$j;
            $xdatam[$i]=$meses[$j]['fecha']['urbano'];
            $ydatam[$i]=$meses[$i]['km_recorridos']['urbano'];
            $j--;
        }

       
        return array('xdata'=>array('carretera'=>$f,'mixto'=>$f,'urbano'=>$f,'total'=>$f), 'ydata'=>array( 'carretera'=>$ydatac, 'mixto'=>$ydatam, 'urbano'=>$ydatau,'total'=>$ydata));
          
      }
      
      
      
      public function comparativaEconomica($params) {
        
        $vehiculo=$this->session->get('vehiculo');

        $lista_datos = $this->em->getRepository('TxinbometroBundle:Gasto')->getAllFrom($vehiculo->getId());
        
        $motototal=$vehiculo->getCoste();

        $costerevisiones=0;
        $costecomplementos=0;
        $costeseguros=0;
        $costerepuestos=0;
        $a='';
        

        $i=0;
        foreach($lista_datos as $dato) {
            if($dato->getTipo()=='revision') $costerevisiones+=$dato->getCoste();
            if($dato->getTipo()=='complemento') $costecomplementos+=$dato->getCoste();
            if($dato->getTipo()=='seguro') $costeseguros+=$dato->getCoste();
            if($dato->getTipo()=='repuesto') $costerepuestos+=$dato->getCoste();            
        }
        
        $costeLitros=$this->session->get('resumenConsumo')->getCosteLitros();

        $sumatotal=$motototal+$costerevisiones+$costecomplementos+$costerepuestos+$costeseguros+$costeLitros['total'];

        $xdata=array('Moto','Revision','Complementos','Seguros','Gasolina','Repuestos');

        $ydata = array($motototal, $costerevisiones,$costecomplementos,$costecomplementos,$costeLitros['total'],$costerepuestos);
       
         
        return array( 'ydata'=>array( 'pie'=>$ydata) ); 
      }
    
}
