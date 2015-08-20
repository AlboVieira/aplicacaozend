<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fornecedor
 *
 * @ORM\Table(name="fornecedor")
 * @ORM\Entity
 */
class Fornecedor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fornecedor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFornecedor;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_fornecedor", type="string", length=145, nullable=false)
     */
    private $nomeFornecedor;

    /**
     * @var string
     *
     * @ORM\Column(name="cnpj", type="string", length=45, nullable=false)
     */
    private $cnpj;


}

