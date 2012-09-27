<?php

namespace DS\TxinbometroBundle\Graph;

use Dafuer\JpgraphBundle\Graph\BaseDataAccess;

class DataSerie extends BaseDataAccess {

    public function __construct() {
        $this->graphindexpath = __DIR__ . "/DataSerie.yml";

        parent::__construct();
    }



    public function consumoGeneralKm($params) {
        
        if (!isset($params['station']))
            return $this->emptyResult();

        $c = \Propel::getConnection();

        $stmt = $c->prepare($query);
        $stmt->execute();

        $xdata = array();
        $stdover=array();
        $stdunder=array();
        $ydata =array();
        $avg=array();

        while ($row = $stmt->fetch()) {

            $xdata[] = $row[0];
            $ydata[] = $row[1];
            $ydata[] = $row[2];
            $ydata[] = $row[3];
            $ydata[] = $row[4];
            $ydata[] = $row[5];
            $avg[] = $row[6];
            $stdover[]=$row[6]+$row[7];
            $stdunder[]=$row[6]-$row[7];
            
            //$c++;
        }

   
        return array( 'xdata'=>array(  'stdover'=>$xdata,'stdunder'=>$xdata,'clim'=>$xdata,'avg'=>$xdata ), 'ydata'=>array( 'stdover'=>$stdover,'stdunder'=>$stdunder,'clim'=>$ydata, 'avg'=>$avg));
    }
}
