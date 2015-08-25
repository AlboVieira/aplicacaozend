<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:35
 */

namespace GerenciaEstoque\Dao;

use Application\Custom\DaoAbstract;

class NotaFiscalDao extends DaoAbstract
{
    protected $entityName = 'GerenciaEstoque\\Entity\\NotaFiscal';

    public function existePedido($idpedido)
    {


        $qb = $this->getCompleteQueryBuilder()
            ->where($this->alias . DaoAbstract::TABLE_COLUMN_SEPARATOR . 'idPedido = :id')
            ->setParameter('id', $idpedido);


        if (count($qb->getQuery()->getResult()) > 0) {
            return true;
        }
        return false;

    }

}