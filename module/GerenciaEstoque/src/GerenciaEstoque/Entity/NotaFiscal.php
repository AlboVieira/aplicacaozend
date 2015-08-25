<?php

namespace GerenciaEstoque\Entity;

use Application\Custom\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;

/**
 * NotaFiscal
 *
 * @ORM\Table(name="nota_fiscal", indexes={@ORM\Index(name="fk_nota_pedido_idx", columns={"id_pedido"})})
 * @ORM\Entity
 */
class NotaFiscal extends EntityAbstract
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_nota_fiscal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotaFiscal;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_nota", type="integer", nullable=false)
     */
    private $numeroNota;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var \GerenciaEstoque\Entity\Pedido
     *
     * @ORM\ManyToOne(targetEntity="GerenciaEstoque\Entity\Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pedido", referencedColumnName="id_pedido")
     * })
     */
    private $idPedido;

    /**
     * @return int
     */
    public function getIdNotaFiscal()
    {
        return $this->idNotaFiscal;
    }

    /**
     * @param int $idNotaFiscal
     */
    public function setIdNotaFiscal($idNotaFiscal)
    {
        $this->idNotaFiscal = $idNotaFiscal;
    }

    /**
     * @return int
     */
    public function getNumeroNota()
    {
        return $this->numeroNota;
    }

    /**
     * @param int $numeroNota
     */
    public function setNumeroNota($numeroNota)
    {
        $this->numeroNota = $numeroNota;
    }

    /**
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     */
    public function setData($data)
    {
        $this->data = new \DateTime($data);
    }

    /**
     * @return Pedido
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * @param Pedido $idPedido
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;
    }


}

