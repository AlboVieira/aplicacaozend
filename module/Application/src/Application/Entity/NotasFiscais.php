<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotasFiscais
 *
 * @ORM\Table(name="notas_fiscais", indexes={@ORM\Index(name="fk_nota_pedido_idx", columns={"id_pedido"})})
 * @ORM\Entity
 */
class NotasFiscais
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
     * @var string
     *
     * @ORM\Column(name="valor_nota", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $valorNota;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_emissao", type="datetime", nullable=false)
     */
    private $dataEmissao;

    /**
     * @var \Application\Entity\Pedido
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pedido", referencedColumnName="id_pedido")
     * })
     */
    private $idPedido;


}

