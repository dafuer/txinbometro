<?php

namespace DS\TxinbometroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DS\TxinbometroBundle\Entity\Gasolina
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DS\TxinbometroBundle\Entity\GasolinaRepository")
 */
class Gasolina
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
     * @var string $user
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

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
     * @var float $litros
     *
     * @ORM\Column(name="litros", type="float")
     */
    private $litros;

    /**
     * @var float $coste
     *
     * @ORM\Column(name="coste", type="float")
     */
    private $coste;

    /**
     * @var string $tipo
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var string $gasolinera
     *
     * @ORM\Column(name="gasolinera", type="string", length=255)
     */
    private $gasolinera;

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
     * Set user
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
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
     * Set litros
     *
     * @param float $litros
     */
    public function setLitros($litros)
    {
        $this->litros = $litros;
    }

    /**
     * Get litros
     *
     * @return float 
     */
    public function getLitros()
    {
        return $this->litros;
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
     * Set gasolinera
     *
     * @param string $gasolinera
     */
    public function setGasolinera($gasolinera)
    {
        $this->gasolinera = $gasolinera;
    }

    /**
     * Get gasolinera
     *
     * @return string 
     */
    public function getGasolinera()
    {
        return $this->gasolinera;
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
}