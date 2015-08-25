<?php

namespace GerenciaEstoque\Entity;

use Application\Custom\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", indexes={@ORM\Index(name="fk_pedido_produto_idx", columns={"id_produto"}), @ORM\Index(name="fk_pedido_fornecedor_idx", columns={"id_fornecedor"})})
 * @ORM\Entity
 */
class Pedido extends EntityAbstract
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_pedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPedido;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valorTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", nullable=false)
     */
    private $descricao;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var float
     *
     * @ORM\Column(name="quantidade", type="float", precision=10, scale=0, nullable=false)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="unidade", type="string", length=2, nullable=false)
     */
    private $unidade;

    /**
     * @var \GerenciaEstoque\Entity\Fornecedor
     *
     * @ORM\ManyToOne(targetEntity="GerenciaEstoque\Entity\Fornecedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fornecedor", referencedColumnName="id_fornecedor")
     * })
     */
    private $idFornecedor;

    /**
     * @var \GerenciaEstoque\Entity\Produto
     *
     * @ORM\ManyToOne(targetEntity="GerenciaEstoque\Entity\Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produto", referencedColumnName="id_produto")
     * })
     */
    private $idProduto;

    /**
     * @return int
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * @param int $idPedido
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;
    }

    /**
     * @return string
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * @param string $valorTotal
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;
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
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * @param string $unidade
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
    }

    /**
     * @return Fornecedor
     */
    public function getIdFornecedor()
    {
        return $this->idFornecedor;
    }

    /**
     * @param Fornecedor $idFornecedor
     */
    public function setIdFornecedor($idFornecedor)
    {
        $this->idFornecedor = $idFornecedor;
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
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }



}

