<?php

namespace GerenciaEstoque\Entity;

use Application\Custom\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;

/**
 * ItemPedido
 *
 * @ORM\Table(name="item_pedido", indexes={@ORM\Index(name="fk_pedido_idx", columns={"id_pedido"}), @ORM\Index(name="fk_produto_idx", columns={"id_produto"})})
 * @ORM\Entity
 */
class ItemPedido extends EntityAbstract
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(name="quantidade", type="float", nullable=false)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var \GerenCiaEstoque\Entity\Pro
     *
     * @ORM\ManyToOne(targetEntity="GerenCiaEstoque\Entity\Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produto", referencedColumnName="id_produto")
     * })
     */
    private $idProduto;

    /**
     * @var \GerenCiaEstoque\Entity\Pedido
     *
     * @ORM\ManyToOne(targetEntity="GerenCiaEstoque\Entity\Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pedido", referencedColumnName="id_pedido")
     * })
     */
    private $idPedido;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param float $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return Produto
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * @param Produto $idProduto
     */
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
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

