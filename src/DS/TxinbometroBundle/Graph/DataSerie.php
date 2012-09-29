<?php

namespace DS\TxinbometroBundle\Graph;

use Dafuer\JpgraphBundle\Graph\BaseDataAccess;

class DataSerie extends BaseDataAccess {

    protected $session;


    public function __construct($session) {
        $this->graphindexpath = __DIR__ . "/DataSerie.yml";

        parent::__construct();
        
        $this->session=$session;
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
  
//        $pieplot->SetLegends($xdata);

//        $lbl = array($km['urbano']."km \n%.1f%%",$km['mixto']."km \n%.1f%%",$km['carretera']."km \n%.1f%%");

//        $pieplot->SetLabels($lbl);
//        $pieplot->SetLabelPos(1);
     
        
        return array( 'ydata'=>array( 'pie'=>$ydata) ); //, 'custom'=>array('pie'=>array('lineplot_slicecolors'=>$colors)) );
    }    
    
}
