<?php

namespace GerenciaEstoque\Entity;

use Application\Custom\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;

/**
 * Estoque
 *
 * @ORM\Table(name="estoque", indexes={@ORM\Index(name="fk_estoque_produto_idx", columns={"id_produto"})})
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
     * @var \GerenciaEstoque\Entity\Produto
     *
     * @ORM\ManyToOne(targetEntity="GerenciaEstoque\Entity\Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produto", referencedColumnName="id_produto")
     * })
     */
    private $idProduto;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

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
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param int $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }


}

