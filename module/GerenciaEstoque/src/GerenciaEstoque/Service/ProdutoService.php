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
use GerenciaEstoque\Entity\Produto;

//use Application\Util\JqGridTable;

class ProdutoService extends ServiceAbstract
{

    public function getGrid(){
        $jqgrid = new JqGridTable();
        $jqgrid->addColunas(array('label' => 'Id','name' => 'idProduto', 'width' => 75));
        $jqgrid->addColunas(array('label' => 'Descricao','name' => 'descricaoProduto','width' => 150));
        $jqgrid->addColunas(array('label' => 'Valor Unitario','name' => 'valorUnitario', 'width' => 150));

        $jqgrid->setUrl('/produto/getDados');
        $jqgrid->setTitle('Produto');

        return $jqgrid->renderJs();
    }

    public function getGridDados(){
        /** @var ProdutoDao $dao */
        $dao = $this->getFromServiceLocator('ProdutoDao');

        $qb = $dao->getCompleteQueryBuilder();

        $jqgrid = new JqGridTable();

        $jqgrid->setAlias('p');
        $jqgrid->setQuery($qb);

        //$paramsPost = $jqgrid->getParametrosFromPost();
        $rows = $jqgrid->getDatatableArray();

        $dados = [];
        foreach($rows['rows'] as $row){
            /** @var Produto $produto */
            $produto = $row;

            //$temp['id'] = $produto->getIdProduto();
            //$temp['cell']['idProduto'] = $produto->getIdProduto();
            $temp['idProduto'] = (string) $produto->getIdProduto();
            $temp['descricaoProduto'] = $produto->getDescricaoProduto();
            $temp['valorUnitario'] = (string) $produto->getValorUnitario();

            $dados[] = $temp;
        }
        //var_dump($rows);die;
        $rows['rows'] = $dados;

        //var_export($rows['registros']);die;

        return $rows;
        //var_dump($qb->getQuery()->getResult());die;
    }


}