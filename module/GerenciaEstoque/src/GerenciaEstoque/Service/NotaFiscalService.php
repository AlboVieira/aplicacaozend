<?php

namespace GerenciaEstoque\Service;

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 20/08/2015
 * Time: 00:11
 */
use Application\Constants\EstoqueConst;
use Application\Constants\ItemPedidoConst;
use Application\Constants\JqGridConst;
use Application\Constants\NotaFiscalConst;
use Application\Constants\PedidoConst;
use Application\Custom\ServiceAbstract;
use Application\Util\JqGridButton;
use Application\Util\JqGridTable;
use GerenciaEstoque\Dao\EstoqueDao;
use GerenciaEstoque\Dao\ItemPedidoDao;
use GerenciaEstoque\Dao\NotaFiscalDao;
use GerenciaEstoque\Dao\PedidoDao;
use GerenciaEstoque\Entity\Estoque;
use GerenciaEstoque\Entity\ItemPedido;
use GerenciaEstoque\Entity\NotaFiscal;

//use Application\Util\JqGridTable;

class NotaFiscalService extends ServiceAbstract
{
    const URL_GET_DADOS = '/nota-fiscal/getDados';

    public function salvar(NotaFiscal $notaFiscal)
    {
        /** @var NotaFiscalDao $dao */
        $dao = $this->getFromServiceLocator(NotaFiscalConst::DAO);


        //somente um pedido por nota
        if ($dao->existePedido($notaFiscal->getIdPedido())) {
            return false;
        }

        $pedido = $this->getFromServiceLocator(PedidoConst::DAO)->getEntity($notaFiscal->getIdPedido());
        $notaFiscal->setIdPedido($pedido);

        if ($notaFiscal = $dao->save($notaFiscal)) {

            /** @var EstoqueDao $estoqueDao */
            $estoqueDao = $this->getFromServiceLocator(EstoqueConst::DAO);
            $idProduto = $notaFiscal->getIdPedido()->getIdProduto()->getIdProduto();

            if (!$estoqueDao->verificaProdutoEmEstoque($idProduto)) {
                /** @var Estoque $estoque */
                $estoque = $estoqueDao->getEntity();
                $estoque->setIdProduto($notaFiscal->getIdPedido()->getIdProduto());
                $estoque->setQuantidade($notaFiscal->getIdPedido()->getQuantidade());
                $estoque->setIdNotaFiscal($notaFiscal);
                $estoqueDao->save($estoque);
            }

        }


        return $notaFiscal;
    }

    public function excluir($id)
    {
        /** @var NotaFiscalDao $dao */
        $dao = $this->getFromServiceLocator(NotaFiscalConst::DAO);
        $notaFiscal = $dao->getEntity($id);
        return $dao->remove($notaFiscal);
    }

    public function getEntity($id)
    {
        /** @var NotaFiscalDao $dao */
        $dao = $this->getFromServiceLocator(NotaFiscalConst::DAO);
        return $dao->getEntity($id);
    }

    public function getGrid()
    {
        $jqgrid = new JqGridTable();
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            NotaFiscalConst::LBL_NUMERO_NOTA, JqGridConst::NAME => NotaFiscalConst::FLD_NUMERO_NOTA, JqGridConst::WIDTH => 100));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_PRODUTO, JqGridConst::NAME => PedidoConst::FLD_PRODUTO, JqGridConst::WIDTH => 100));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_FORNECEDOR, JqGridConst::NAME => PedidoConst::FLD_FORNECEDOR, JqGridConst::WIDTH => 100));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_QTD, JqGridConst::NAME => PedidoConst::FLD_QTD, JqGridConst::WIDTH => 100));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_UNIDADE, JqGridConst::NAME => PedidoConst::FLD_UNIDADE, JqGridConst::WIDTH => 150));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            NotaFiscalConst::LBL_DATA, JqGridConst::NAME => NotaFiscalConst::FLD_DATA, JqGridConst::WIDTH => 150));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_VALOR_TOTAL, JqGridConst::NAME => PedidoConst::FLD_VALOR_TOTAL, JqGridConst::WIDTH => 100));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            'Acao', JqGridConst::NAME => 'acao', JqGridConst::WIDTH => 60, JqGridConst::CLASSCSS => 'text-center'));

        $jqgrid->setUrl(self::URL_GET_DADOS);
        $jqgrid->setTitle('Nota Fiscal');

        return $jqgrid->renderJs();
    }

    public function getGridDados()
    {
        /** @var NotaFiscalDao $dao */
        $dao = $this->getFromServiceLocator(NotaFiscalConst::DAO);

        $qb = $dao->getCompleteQueryBuilder();

        $jqgrid = new JqGridTable();
        $jqgrid->setAlias('n');
        $jqgrid->setQuery($qb);

        //$paramsPost = $jqgrid->getParametrosFromPost();
        $rows = $jqgrid->getDatatableArray();


        $dados = [];
        foreach ($rows[JqGridConst::PARAM_REGISTROS] as $row) {
            /** @var NotaFiscal $notaFiscal */
            $notaFiscal = $row;
            $idNotaFiscal = $notaFiscal->getIdNotaFiscal();
            $temp[NotaFiscalConst::FLD_NUMERO_NOTA] = $notaFiscal->getNumeroNota();
            $temp[PedidoConst::FLD_FORNECEDOR] = $notaFiscal->getIdPedido()->getIdFornecedor()->getNomeFornecedor();
            $temp[NotaFiscalConst::FLD_DATA] = date_format($notaFiscal->getData(), 'd/m/Y');
            $temp[PedidoConst::FLD_UNIDADE] = $notaFiscal->getIdPedido()->getUnidade();
            $temp[PedidoConst::FLD_PRODUTO] = $notaFiscal->getIdPedido()->getIdProduto()->getNomeProduto();
            $temp[PedidoConst::FLD_QTD] = $notaFiscal->getIdPedido()->getQuantidade();
            $temp[PedidoConst::FLD_VALOR_TOTAL] = $notaFiscal->getIdPedido()->getValorTotal();

            $botaoEditar = new JqGridButton();
            $botaoEditar->setTitle('Editar');
            $botaoEditar->setClass('btn btn-primary btn-xs');
            $botaoEditar->setUrl('/nota-fiscal/editar/' . $idNotaFiscal);
            $botaoEditar->setIcon('glyphicon glyphicon-edit');

            $botaoExcluir = new JqGridButton();
            $botaoExcluir->setTitle('Excluir');
            $botaoExcluir->setClass('btn btn-danger btn-xs');
            $botaoExcluir->setUrl('/nota-fiscal/excluir/' . $idNotaFiscal);
            $botaoExcluir->setIcon('glyphicon glyphicon-trash');
            //$botaoExcluir->getOnClick();

            $temp[JqGridConst::ACAO] = "<div class='agrupa-botoes'>" . $botaoEditar->render() . $botaoExcluir->render() .
                "</div>";

            $dados[] = $temp;
        }
        $rows[JqGridConst::PARAM_REGISTROS] = $dados;

        return $rows;
    }

    public function getPedidos()
    {
        /** @var PedidoDao $dao */
        $dao = $this->getFromServiceLocator(PedidoConst::DAO);
        return $dao->findPedidosSemNota();
    }
}