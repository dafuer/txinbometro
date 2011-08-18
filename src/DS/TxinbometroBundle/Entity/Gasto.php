<?php

namespace DS\TxinbometroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DS\TxinbometroBundle\Entity\Gasto
 *
 * @ORM\Table(name="txinbometro_gasto")
 * @ORM\Entity(repositoryClass="DS\TxinbometroBundle\Repository\GastoRepository")
 */
class Gasto
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Vehiculo", inversedBy="vehiculos", cascade={"persist"}) 
     * @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id")
     * 
     */
    protected $vehiculo;

    /**
     * @var integer $km
     *
     * @ORM\Column(name="km", type="integer")
     */
    private $km;

    /**
     * @var datetime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string $tipo
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var float $coste
     *
     * @ORM\Column(name="coste", type="float")
     */
    private $coste;

    /**
     * @var string $comentario
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     */
    private $comentario;



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
     * Set km
     *
     * @param integer $km
     */
    public function setKm($km)
    {
        $this->km = $km;
    }

    /**
     * Get km
     *
     * @return integer 
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime 
     */
    public function getFecha()
    {
        return $this->fecha;
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
     * Set comentario
     *
     * @param string $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set vehiculo
     *
     * @param DS\TxinbometroBundle\Entity\Vehiculo $vehiculo
     */
    public function setVehiculo(\DS\TxinbometroBundle\Entity\Vehiculo $vehiculo)
    {
        $this->vehiculo = $vehiculo;
    }

    /**
     * Get vehiculo
     *
     * @return DS\TxinbometroBundle\Entity\Vehiculo 
     */
    public function getVehiculo()
    {
        return $this->vehiculo;
    }
}