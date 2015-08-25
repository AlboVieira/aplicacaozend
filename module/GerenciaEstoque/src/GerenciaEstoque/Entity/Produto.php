<?php

namespace GerenciaEstoque\Entity;

use Application\Custom\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="produto")
 * @ORM\Entity
 */
class Produto extends EntityAbstract
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_produto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_produto", type="string", length=145, nullable=false)
     */
    private $nomeProduto;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_unitario", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valorUnitario;


    /**
     * @return int
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * @param int $idProduto
     */
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    /**
     * @return string
     */
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    /**
     * @param string $nomeProduto
     */
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;
    }

    /**
     * @return string
     */
    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    /**
     * @param string $valorUnitario
     */
    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;
    }

}

