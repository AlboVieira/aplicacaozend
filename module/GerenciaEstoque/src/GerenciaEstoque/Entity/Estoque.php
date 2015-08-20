<?php

namespace GerenciaEstoque\Entity;

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


}

