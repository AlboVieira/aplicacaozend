<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:35
 */

namespace GerenciaEstoque\Dao;
use \Application\Custom\Dao\BaseDaoAbstract;

class ProdutoDao extends BaseDaoAbstract
{
    protected $entityName = 'GerenciaEstoque\\Entity\\Produto';
    protected $entityManager;

    public function __construct(){
        //$this->entityManager =
    }
}