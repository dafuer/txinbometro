<?php

namespace DS\TxinbometroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DS\TxinbometroBundle\Entity\Vehiculo
 * 
 * @ORM\Entity(repositoryClass="DS\TxinbometroBundle\Repository\VehiculoRepository")
 * @ORM\Table(name="txinbometro_vehiculo")
 */
Class Vehiculo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="vehiculos", cascade={"persist"})  
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * 
     * Usuario al que pertenece el vehiculo
     */
    protected $usuario;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $tipo;    
    
    /**
     * @ORM\Column(type="string")
     */
    protected $marca;
    /**
     * @ORM\Column(type="string")
     */
    protected $modelo;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $compra;
    /**
     * @ORM\Column(type="float")
     */
    protected $coste;
    /**
     * @ORM\Column(type="integer")
     */
    protected $km_iniciales;
    /**
     * @ORM\Column(type="float")
     */
    protected $capacidad;

    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set marca
     *
     * @param string $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set compra
     *
     * @param datetime $compra
     */
    public function setCompra($compra)
    {
        $this->compra = $compra;
    }

    /**
     * Get compra
     *
     * @return datetime 
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set coste
     *
     * @param float $coste
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;
    }

    /**
     * Get coste
     *
     * @return float 
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * Set km_iniciales
     *
     * @param integer $kmIniciales
     */
    public function setKmIniciales($kmIniciales)
    {
        $this->km_iniciales = $kmIniciales;
    }

    /**
     * Get km_iniciales
     *
     * @return integer 
     */
    public function getKmIniciales()
    {
        return $this->km_iniciales;
    }

    /**
     * Set capacidad
     *
     * @param float $capacidad
     */
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;
    }

    /**
     * Get capacidad
     *
     * @return float 
     */
    public function getCapacidad()
    {
        return $this->capacidad;
    }

    /**
     * Set usuario
     *
     * @param DS\TxinbometroBundle\Entity\Usuario $usuario
     */
    public function setUsuario(\DS\TxinbometroBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return DS\TxinbometroBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}