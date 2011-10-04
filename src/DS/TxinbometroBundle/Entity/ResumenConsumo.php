<?php

namespace DS\TxinbometroBundle\Entity;

class ResumenConsumo {

    /**
     * Es una tabla que contiene para cada repostaje
     * km
     * km_recorridos
     * dias
     * fecha
     * comentario
     * coste
     * litros
     * consumo
     * coste_km
     * tipo
     * km
     * autonomia
     * km_restantes
     * desposito_restante
     * km_dia
     */
    protected $listado;
    protected $km;
    protected $dias;
    protected $litros;
    protected $costeLitros; // Representa el total de euros dedicado a combustible
    protected $consumo;
    protected $costeKm;
    protected $frecuencia;
    protected $kmDia;
    protected $meses;
    protected $costeLitro; // Representa el coste por litro

    public function getListado() {
        return $this->listado;
    }
    
    public function getListadoParaKm($km){        
        foreach ($this->listado as $linea){
            if($linea['km']==$km) return $linea;
        }
        
        return null;
    }

    public function getKm() {
        return $this->km;
    }

    public function getDias() {
        return $this->dias;
    }

    public function getLitros() {
        return $this->litros;
    }
    
    public function getCosteLitros() {
        return $this->costeLitros;
    }

    public function getConsumo() {
        return $this->consumo;
    }

    public function getCosteKm() {
        return $this->costeKm;
    }

    public function getFrecuencia() {
        return $this->frecuencia;
    }

    public function getKmDia() {
        return $this->kmDia;
    }
    
    public function getMeses(){
        return $this->meses;
    }
    
    public function getCosteLitro(){
        return $this->costeLitro;
    }

    public function setListado($x) {
        $this->listado = $x;
    }

    public function setKm($x) {
        $this->km = $x;
    }

    public function setDias($x) {
        $this->dias = $x;
    }

    public function setLitros($x) {
        $this->litros = $x;
    }
    
    public function setCosteLitros($x) {
        $this->costeLitros = $x;
    }

    public function setConsumo($x) {
        $this->consumo = $x;
    }

    public function setCosteKm($x) {
        $this->costeKm = $x;
    }

    public function setFrecuencia($x) {
        $this->frecuencia = $x;
    }

    public function setkmDia($x) {
        $this->kmDia = $x;
    }
    
    public function setMeses($x){
        $this->meses=$x;
    }
    
    public function setCosteLitro($x){
        $this->costeLitro=$x;
    }

}