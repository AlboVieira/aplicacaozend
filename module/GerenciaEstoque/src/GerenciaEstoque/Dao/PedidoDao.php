<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:35
 */

namespace GerenciaEstoque\Dao;

use Application\Custom\DaoAbstract;
use Doctrine\ORM\Query\Expr;

class PedidoDao extends DaoAbstract
{
    protected $entityName = 'GerenciaEstoque\\Entity\\Pedido';

    public function findPedidosSemNota()
    {
        $qb = $this->getCompleteQueryBuilder()
            ->leftJoin('GerenciaEstoque\Entity\NotaFiscal', 'nota', 'WITH', 'p.idPedido = nota.idPedido')
            ->andWhere('nota.idPedido IS NULL');
        return $qb->getQuery()->getArrayResult();
    }
}