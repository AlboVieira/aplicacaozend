<?php

namespace GerenciaEstoque\Service;
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 20/08/2015
 * Time: 00:11
 */
use Application\Custom\ServiceAbstract;
use Application\Util\JqGridTable;
use GerenciaEstoque\Dao\ProdutoDao;

//use Application\Util\JqGridTable;

class ProdutoService extends ServiceAbstract
{
    public function getGrid(){

        /** @var ProdutoDao $dao */
        $dao = $this->getFromServiceLocator('ProdutoDao');

        $produto = $dao->getCompleteQueryBuilder();

        //var_dump($dao);die;

        $jqgrid = new JqGridTable();
        $jqgrid->setUrl('/gerencia-estoque/produto');


        return $jqgrid;
    }
}