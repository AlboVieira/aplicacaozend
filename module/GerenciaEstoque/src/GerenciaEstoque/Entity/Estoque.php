<?php

namespace GerenciaEstoque\Entity;
use Application\Custom\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;

/**
 * Estoque
 *
 * @ORM\Table(name="estoque", indexes={@ORM\Index(name="fk_estoque_produto_idx", columns={"id_produto"}), @ORM\Index(name="fk_estoque_nota_idx", columns={"id_nota_fiscal"})})
 * @ORM\Entity
 */
class Estoque extends EntityAbstract
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_estoque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstoque;

    /**
     * @var float
     *
     * @ORM\Column(name="quantidade", type="float", precision=10, scale=0, nullable=false)
     */
    private $quantidade;

    /**
     * @var \GerenciaEstoque\Entity\NotaFiscal
     *
     * @ORM\ManyToOne(targetEntity="GerenciaEstoque\Entity\NotaFiscal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nota_fiscal", referencedColumnName="id_nota_fiscal")
     * })
     */
    private $idNotaFiscal;

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
    public function getIdEstoque()
    {
        return $this->idEstoque;
    }

    /**
     * @param int $idEstoque
     */
    public function setIdEstoque($idEstoque)
    {
        $this->idEstoque = $idEstoque;
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
     * @return \Application\
     */
    public function getIdNotaFiscal()
    {
        return $this->idNotaFiscal;
    }

    /**
     * @param \Application\ $idNotaFiscal
     */
    public function setIdNotaFiscal($idNotaFiscal)
    {
        $this->idNotaFiscal = $idNotaFiscal;
    }

    /**
     * @return \Application\
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * @param \Application\ $idProduto
     */
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }


}

