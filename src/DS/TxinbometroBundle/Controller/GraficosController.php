<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class GraficosController extends Controller
{
    /**
     * 
     * @Template()
     */
    public function graphAction() {
        $vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();
        
        $em = $this->getDoctrine()->getEntityManager();
        
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph.php';
        include_once __DIR__ . '/../../../../vendor/jpgraph/jpgraph_line.php';

        
        $consumoObject=$em->getRepository('TxinbometroBundle:Gasolina')->getConsumos($vehiculo);
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
    
    

}
