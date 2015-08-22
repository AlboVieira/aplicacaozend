<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estoque
 *
 * @ORM\Table(name="estoque", indexes={@ORM\Index(name="fk_produto_idx", columns={"id_produto"})})
 * @ORM\Entity
 */
class Estoque
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
     * @var string
     *
     * @ORM\Column(name="quantidade_estoque", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $quantidadeEstoque;

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
     * @return string
     */
    public function getQuantidadeEstoque()
    {
        return $this->quantidadeEstoque;
    }

    /**
     * @param string $quantidadeEstoque
     */
    public function setQuantidadeEstoque($quantidadeEstoque)
    {
        $this->quantidadeEstoque = $quantidadeEstoque;
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



}

