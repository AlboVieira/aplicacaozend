<?php

namespace GerenciaEstoque\Service;

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 20/08/2015
 * Time: 00:11
 */
use Application\Constants\EstoqueConst;
use Application\Constants\JqGridConst;
use Application\Custom\ServiceAbstract;
use Application\Util\JqGridTable;
use GerenciaEstoque\Dao\EstoqueDao;

//use Application\Util\JqGridTable;

class EstoqueService extends ServiceAbstract
{
    const URL_GET_DADOS = '/estoque/getDados';


    public function getGrid()
    {

        $jqgrid = new JqGridTable();
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            EstoqueConst::LBL_ID_PRODUTO, JqGridConst::NAME => EstoqueConst::FLD_ID_PRODUTO, JqGridConst::WIDTH => 400));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            EstoqueConst::LBL_QTD_PRODUTO, JqGridConst::NAME => EstoqueConst::FLD_QTD_PRODUTO, JqGridConst::WIDTH => 150));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            EstoqueConst::LBL_NOTA, JqGridConst::NAME => EstoqueConst::FLD_NOTA, JqGridConst::WIDTH => 150));

        $jqgrid->setUrl(self::URL_GET_DADOS);
        $jqgrid->setTitle('Estoque');

        return $jqgrid->renderJs();
    }

    public function getGridDados()
    {

        /** @var EstoqueDao $dao */
        $dao = $this->getFromServiceLocator(EstoqueConst::DAO);

        $qb = $dao->getCompleteQueryBuilder();

        $jqgrid = new JqGridTable();
        $jqgrid->setAlias('e');
        $jqgrid->setQuery($qb);

        //$paramsPost = $jqgrid->getParametrosFromPost();
        $rows = $jqgrid->getDatatableArray();

        $dados = [];
        foreach ($rows[JqGridConst::PARAM_REGISTROS] as $row) {
            /** @var \GerenciaEstoque\Entity\Estoque $estoque */
            $estoque = $row;
            $temp[EstoqueConst::FLD_ID_PRODUTO] = $estoque->getIdProduto()->getNomeProduto();
            $temp[EstoqueConst::FLD_QTD_PRODUTO] = (string)$estoque->getQuantidade();
            $temp[EstoqueConst::FLD_NOTA] = (string)$estoque->getIdNotaFiscal()->getNumeroNota();


            $dados[] = $temp;
        }
        $rows[JqGridConst::PARAM_REGISTROS] = $dados;

        return $rows;
    }


}