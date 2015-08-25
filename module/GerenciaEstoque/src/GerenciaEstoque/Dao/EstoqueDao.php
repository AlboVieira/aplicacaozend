<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:35
 */

namespace GerenciaEstoque\Dao;

use Application\Custom\DaoAbstract;

class EstoqueDao extends DaoAbstract
{
    protected $entityName = 'GerenciaEstoque\\Entity\\Estoque';

    public function verificaProdutoEmEstoque($idproduto)
    {
        $qb = $this->getCompleteQueryBuilder()
            ->where($this->alias . DaoAbstract::TABLE_COLUMN_SEPARATOR . 'idProduto = :id')
            ->setParameter('id', $idproduto);

        if ($qb->getQuery()->getMaxResults()) {
            return true;
        }
        return false;
    }
}