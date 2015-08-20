<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemPedido
 *
 * @ORM\Table(name="item_pedido", indexes={@ORM\Index(name="fk_pedido_idx", columns={"id_pedido"}), @ORM\Index(name="fk_produto_idx", columns={"id_produto"})})
 * @ORM\Entity
 */
class ItemPedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="quantidade", type="float", precision=10, scale=0, nullable=false)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var \Application\Entity\Produto
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produto", referencedColumnName="id_produto")
     * })
     */
    private $idProduto;

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

