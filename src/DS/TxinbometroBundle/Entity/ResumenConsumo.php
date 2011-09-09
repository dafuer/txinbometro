<?php

namespace DS\TxinbometroBundle\Entity;

class ResumenConsumo {

    protected $listado;
    protected $km;
    protected $dias;
    protected $litros;
    protected $consumo;
    protected $costeKm;
    protected $frecuencia;
    protected $kmDia;

    public function getListado() {
        return $this->listado;
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

}