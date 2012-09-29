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
    
    
    /**
    
    public function consumogeneralkmAction() {
        //$vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();
        
        $vehiculo=$sesion->get('vehiculo');
        
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_line.php';

        
        $consumoObject=$sesion->get('resumenConsumo');
        
        $this->lista=$consumoObject->getListado();
        
        $c=0;
        $f=array();
        $xdata=array();
        $ydata=array();


	$ydataacumulado=array();
	
	
        // Creo los puntos
        for ($i=0;$i<count($this->lista);$i++) {
            $f[$i]=$this->lista[$i]['km'];
            //$xdata[$i]=strtotime($this->lista[$i]['fecha']);
            $xdata[$i]=$this->lista[$i]['km'];
            $ydata[$i]=$this->lista[$i]['consumo'];
            
            if($i>0) $ydataacumulado[$i]=(($ydataacumulado[$i-1]*$i)+$this->lista[$i]['consumo'])/($i+1);
            else $ydataacumulado[$i]=$ydata[$i]=$this->lista[$i]['consumo'];
            
        }

        // La escala de datos
        $mayorx=max($xdata);
        $minimox=min($xdata);
        $mayory=max($ydata);
        //$minimoy=min($ydata);
        $resto=$mayory%$mayory;
        $mayory=$mayory-$resto+1;

        // Create the graph. These two calls are always required
        $graph = new \Graph(600,400);//,"auto");

        //$graph->SetScale("textlin");
        $graph->SetScale('intlin',0 ,$mayory,$minimox,$mayorx);
        // Pongo ticks manuales, para que los limites del eje y queden bonitos y ademas
        // El color del fragmento de valores de Y mayores no quede con fondo blanco
        $graph->yscale->SetAutoTicks();
        $graph->img->SetAntiAliasing();
        //$graph->xgrid->Show();
        $graph->SetMarginColor('#fdffd1');
        $graph->SetFrame(true, '#fdffd1');
        // Create the linear plot
        $lineplot=new \LinePlot($ydata,$xdata);
        //$lineplot->mark->SetType(MARK_X);
        //$lineplot->value->Show();
        //$lineplot->SetCenter();
        

        //Añado las areas de colores
        for ($i=1;$i<count($this->lista);$i++) {
            switch($this->lista[$i]['tipo']) {
                case 'carretera':
                    $color='#7dda7a@0.8';
                    break;
                case 'mixto':
                    $color='#e8ea60@0.8';
                    break;
                case 'urbano':
                    $color='#d86464@0.8';
                    break;
            }

            $lineplot->AddArea($i-1,$i,LP_AREA_FILLED,$color);
        }
        $lineplot->mark->SetWidth(1);




        //Establezco las lineas de maximo, minimo y media
        $consumo=$consumoObject->getConsumo();
        $ymedia[0]=$consumo['total']['medio'];
        $ymedia[1]=$consumo['total']['medio'];
        $ymax[0]=$consumo['total']['maximo'];
        $ymax[1]=$consumo['total']['maximo'];
        $ymin[0]=$consumo['total']['minimo'];
        $ymin[1]=$consumo['total']['minimo'];


        $xmedia[0]=$minimox;
        $xmedia[1]=$mayorx;
        $xmax[0]=$minimox;
        $xmax[1]=$mayorx;
        $xmin[0]=$minimox;
        $xmin[1]=$mayorx;

        $mediaplot=new \LinePlot($ymedia,$xmedia);
        $graph->Add($mediaplot);
        $mediaplot->SetColor('#FF9999');
        
        $maxplot=new \LinePlot($ymax,$xmax);
        $graph->Add($maxplot);
        $maxplot->SetColor('#888888');

        $minplot=new \LinePlot($ymin,$xmin);
        $graph->Add($minplot);
        $minplot->SetColor('#777777');

        $acumuladoplot=new \LinePlot($ydataacumulado,$xdata);
        $graph->Add($acumuladoplot);
        $acumuladoplot->SetColor('black');
        $acumuladoplot->SetWeight(1);

        $graph->xaxis->SetLabelAngle(90);
        // Setup margin and titles
        $graph->img->SetMargin(40,20,20,40);
        $graph->title->Set("Consumo general");
        $graph->xaxis->title->Set("km");
        $graph->yaxis->title->Set("litros/100km");
        $graph->ygrid->SetFill(true,'#fdffd1','#fdffd1');
        //$graph->ygrid->SetFill(true,'#DFFFD1','#DFFFD1@0.5');
        //$graph->SetShadow();
        $graph->xaxis->SetTickLabels($f);
        // Add the plot to the graph
        $graph->Add($lineplot);
        $lineplot->SetColor("#293c82");
        $lineplot->SetWeight(1);
//$graph->SetGridDepth(false);
        // Display the graph
        return $graph->Stroke();

        
    }
    
    
    public function comparativausoAction() {

        //$vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();
        $sesion=$this->get('session');
        
        $vehiculo=$sesion->get('vehiculo');
        
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_pie.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_pie3d.php';

        
        $consumoObject=$sesion->get('resumenConsumo');
        
        //$this->lista=$consumoObject->getListado();
       
        $xdata=array('Urabano','Mixto','Carretera');
        $km=$consumoObject->getKm();
        $ydata = array($km['urbano'], $km['mixto'],$km['carretera']);
        $graph = new \PieGraph(500, 300);//, "auto");
        //$graph->SetScale("textlin");
        $graph->img->SetMargin(40, 20, 20, 40);
        $graph->title->Set("Comparativa de uso");
        //$graph->xaxis->title->Set("Tipo de uso" );
        //$graph->yaxis->title->Set("Km" );

        $pieplot =new \PiePlot3D($ydata);
        $graph->Add($pieplot);
        $pieplot->SetLegends($xdata);

        // Use percentage values in the legends values (This is also the default)
//$pieplot->SetLabelType(PIE_VALUE_PER);

// The label array values may have printf() formatting in them. The argument to the
// form,at string will be the value of the slice (either the percetage or absolute
// depending on what was specified in the SetLabelType() above.
        $lbl = array($km['urbano']."km \n%.1f%%",$km['mixto']."km \n%.1f%%",$km['carretera']."km \n%.1f%%");

//$lbl = array($km['urbano']."km", $km['mixto']."km",$km['carretera']."km");
        $pieplot->SetLabels($lbl);
        $pieplot->SetLabelPos(1);
        $pieplot->SetSliceColors(array('#d86464','#e8ea60','#7dda7a'));
        //$barplot->SetColor("orange");
        //$graph->xaxis->SetTickLabels($xdata);
        //$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#DDDDDD@0.5');
        $graph->SetMarginColor('#fdffd1');
        $graph->SetFrame(true, '#fdffd1');
        
        return $graph->Stroke();
    }    
    
    
    public function usomensualAction(){
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_line.php';
        
        $this->meses=$this->get('session')->get('resumenConsumo')->getMeses();

        $c=0;
        $f=array();
        $xdata=array();
        $ydata=array();

        $j=count($this->meses)-1;
        // Creo los puntos
        for ($i=0;$i<count($this->meses);$i++) {
            $f[$i]=$j;
            $xdata[$i]=$this->meses[$j]['fecha']['total'];
            $ydata[$i]=$this->meses[$i]['km_recorridos']['total'];

            $fc[$i]=$j;
            $xdatac[$i]=$this->meses[$j]['fecha']['carretera'];
            $ydatac[$i]=$this->meses[$i]['km_recorridos']['carretera'];

            $fu[$i]=$j;
            $xdatau[$i]=$this->meses[$j]['fecha']['mixto'];
            $ydatau[$i]=$this->meses[$i]['km_recorridos']['mixto'];

            $fm[$i]=$j;
            $xdatam[$i]=$this->meses[$j]['fecha']['urbano'];
            $ydatam[$i]=$this->meses[$i]['km_recorridos']['urbano'];
            $j--;
        }


        // La escala de datos
        $mayorx=max($f);
        $minimox=min($f);
        $mayory=max($ydata);
        $minimoy=min($ydata);

        $graph = new \Graph(600,400);//,"auto");

        //$graph->SetScale("textlin");
        $graph->SetScale('intlin',0 ,$mayory,$minimox,$mayorx);
        $graph->yscale->SetAutoTicks();
        $graph->SetMarginColor('#fdffd1');
        $graph->SetFrame(true, '#fdffd1');

        // Inserto las lineas en el orden inverso al interesante para que si se solapan la que mejor se vea sea la mas interesante
        $cplot=new \LinePlot($ydatac,$f);
        $graph->Add($cplot);        
        $cplot->SetColor('#7dda7a');
        $cplot->SetWeight(1);

        $mplot=new \LinePlot($ydatau,$f);
        $graph->Add($mplot);
        $mplot->SetColor('#e8ea60');
        $mplot->SetWeight(1);

        $uplot=new \LinePlot($ydatam,$f);
        $graph->Add($uplot);
        $uplot->SetColor('#d86464');
        $uplot->SetWeight(1);

        // Create the linear plot
        $lineplot=new \LinePlot($ydata,$f);
        $graph->Add($lineplot);        
        $lineplot->SetColor("#293c82");
        $lineplot->SetWeight(1);
        $lineplot->mark->SetWidth(2);
        
        $graph->xaxis->SetLabelAngle(90);
        // Setup margin and titles
        $graph->img->SetMargin(40,20,20,60);
        $graph->title->Set("Uso mensual");
        $graph->xaxis->title->Set("ano/mes");
        $graph->yaxis->title->Set("Km's");
        $graph->ygrid->SetFill(true,'#fdffd1@0','#fdffd1@0');
        $graph->xaxis->SetTickLabels($xdata);

        // Display the graph
        return $graph->Stroke();       
        
    }
    
    public function comparativaeconomicaAction(){
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_pie.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_pie3d.php';
        
        $vehiculo=$this->get('session')->get('vehiculo');

        $em = $this->getDoctrine()->getEntityManager();

        $lista_datos = $em->getRepository('TxinbometroBundle:Gasto')->getAllFrom($vehiculo->getId());   
        
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
        
        $costeLitros=$this->get('session')->get('resumenConsumo')->getCosteLitros();

        $sumatotal=$motototal+$costerevisiones+$costecomplementos+$costerepuestos+$costeseguros+$costeLitros['total'];

        $xdata=array('Moto','Revision','Complementos','Seguros','Gasolina','Repuestos');

        $ydata = array($motototal, $costerevisiones,$costecomplementos,$costecomplementos,$costeLitros['total'],$costerepuestos);
        $graph = new \PieGraph(500, 300);
        $graph->img->SetMargin(40, 20, 20, 40);
        $graph->title->Set("Comparativa de gastos");

        $pieplot =new \PiePlot3D($ydata);
        $graph->Add($pieplot);
        $pieplot->SetLegends($xdata);

        //$lbl = array($motototal."km \n%.1f%%",$costerevisiones."km \n%.1f%%",$costecomplementos."km \n%.1f%%");

        //$pieplot->SetLabels($lbl);
        $pieplot->SetLabelPos(1);
        $pieplot->SetSliceColors(array('#d86464','#e8ea60','#7dda7a','#ddaaaa','#aaaadd','#aaddaa'));
        //$pieplot->SetTheme("pastel");
        $graph->SetMarginColor('#fdffd1');
        $graph->SetFrame(true, '#fdffd1');
        
        $graph->Stroke();        
    }
*/
}
