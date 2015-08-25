<?php

namespace GerenciaEstoque\Service;

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 20/08/2015
 * Time: 00:11
 */
use Application\Constants\FornecedorConst;
use Application\Constants\ItemPedidoConst;
use Application\Constants\JqGridConst;
use Application\Constants\PedidoConst;
use Application\Constants\ProdutoConst;
use Application\Custom\ServiceAbstract;
use Application\Util\JqGridButton;
use Application\Util\JqGridTable;
use GerenciaEstoque\Dao\FornecedorDao;
use GerenciaEstoque\Dao\ItemPedidoDao;
use GerenciaEstoque\Dao\PedidoDao;
use GerenciaEstoque\Entity\ItemPedido;
use GerenciaEstoque\Entity\Pedido;

//use Application\Util\JqGridTable;

class PedidoService extends ServiceAbstract
{
    const URL_GET_DADOS = '/pedido/getDados';

    public function salvar(Pedido $pedido, $isEdit = null)
    {
        /** @var PedidoDao $dao */
        $dao = $this->getFromServiceLocator(PedidoConst::DAO);

        $fornecedor = $this->getFromServiceLocator(FornecedorConst::DAO)->getEntity($pedido->getIdFornecedor());
        $produto = $this->getFromServiceLocator(ProdutoConst::DAO)->getEntity($pedido->getIdProduto());
        $pedido->setIdFornecedor($fornecedor);
        $pedido->setIdProduto($produto);

        $pedido->setValorTotal($produto->getValorUnitario() * $pedido->getQuantidade());

        $dao->save($pedido);

        return $pedido;
    }

    public function excluir($id)
    {
        /** @var FornecedorDao $dao */
        $dao = $this->getFromServiceLocator(PedidoConsta::DAO);
        $pedido = $dao->getEntity($id);
        return $dao->remove($pedido);
    }

    public function getEntity($id)
    {
        /** @var PedidoDao $dao */
        $dao = $this->getFromServiceLocator(PedidoConst::DAO);
        return $dao->getEntity($id);
    }

    public function getGrid()
    {
        $jqgrid = new JqGridTable();
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_ID_PEDIDO, JqGridConst::NAME => PedidoConst::FLD_ID_PEDIDO, JqGridConst::WIDTH => 60));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_DESCRICAO, JqGridConst::NAME => PedidoConst::FLD_DESCRICAO, JqGridConst::WIDTH => 200));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_FORNECEDOR, JqGridConst::NAME => PedidoConst::FLD_FORNECEDOR, JqGridConst::WIDTH => 200));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_DATA, JqGridConst::NAME => PedidoConst::FLD_DATA, JqGridConst::WIDTH => 100));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_PRODUTO, JqGridConst::NAME => PedidoConst::FLD_PRODUTO, JqGridConst::WIDTH => 150));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_QTD, JqGridConst::NAME => PedidoConst::FLD_QTD, JqGridConst::WIDTH => 110));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_UNIDADE, JqGridConst::NAME => PedidoConst::FLD_UNIDADE, JqGridConst::WIDTH => 80));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            PedidoConst::LBL_VALOR_TOTAL, JqGridConst::NAME => PedidoConst::FLD_VALOR_TOTAL, JqGridConst::WIDTH => 110));
        $jqgrid->addColunas(array(JqGridConst::LABEL =>
            'Acao', JqGridConst::NAME => 'acao', JqGridConst::WIDTH => 80, JqGridConst::CLASSCSS => 'text-center'));

        $jqgrid->setUrl(self::URL_GET_DADOS);
        $jqgrid->setTitle('Pedidos');

        return $jqgrid->renderJs();
    }

    public function getGridDados()
    {
        /** @var PedidoDao $dao */
        $dao = $this->getFromServiceLocator(PedidoConst::DAO);

        $qb = $dao->getCompleteQueryBuilder();

        $jqgrid = new JqGridTable();
        $jqgrid->setAlias('p');
        $jqgrid->setQuery($qb);

        //$paramsPost = $jqgrid->getParametrosFromPost();
        $rows = $jqgrid->getDatatableArray();


        $dados = [];
        foreach ($rows[JqGridConst::PARAM_REGISTROS] as $row) {
            /** @var Pedido $pedido */
            $pedido = $row;
            $idPedido = $pedido->getIdPedido();
            $temp[PedidoConst::FLD_ID_PEDIDO] = (string)$idPedido;
            $temp[PedidoConst::FLD_DESCRICAO] = $pedido->getDescricao();
            $temp[PedidoConst::FLD_FORNECEDOR] = $pedido->getIdFornecedor()->getNomeFornecedor();
            $temp[PedidoConst::FLD_DATA] = date_format($pedido->getData(), 'd/m/Y');
            $temp[PedidoConst::FLD_UNIDADE] = $pedido->getUnidade();
            $temp[PedidoConst::FLD_PRODUTO] = $pedido->getIdProduto()->getNomeProduto();
            $temp[PedidoConst::FLD_QTD] = $pedido->getQuantidade();
            $temp[PedidoConst::FLD_VALOR_TOTAL] = (string)$pedido->getValorTotal() ? $pedido->getValorTotal() : '0.0';

            $botaoEditar = new JqGridButton();
            $botaoEditar->setTitle('Editar');
            $botaoEditar->setClass('btn btn-primary btn-xs');
            $botaoEditar->setUrl('/pedido/editar/' . $idPedido);
            $botaoEditar->setIcon('glyphicon glyphicon-edit');

            $botaoExcluir = new JqGridButton();
            $botaoExcluir->setTitle('Excluir');
            $botaoExcluir->setClass('btn btn-danger btn-xs');
            $botaoExcluir->setUrl('/pedido/excluir/' . $idPedido);
            $botaoExcluir->setIcon('glyphicon glyphicon-trash');
            //$botaoExcluir->getOnClick();

            $temp[JqGridConst::ACAO] = "<div class='agrupa-botoes'>" . $botaoEditar->render() . $botaoExcluir->render() .
                "</div>";

            $dados[] = $temp;
        }
        $rows[JqGridConst::PARAM_REGISTROS] = $dados;

        return $rows;
    }


    public function getFornecedores()
    {
        /** @var FornecedorDao $dao */
        $dao = $this->getFromServiceLocator(FornecedorConst::DAO);
        return $dao->findAll();
    }

    public function getProdutos()
    {
        /** @var FornecedorDao $dao */
        $dao = $this->getFromServiceLocator(ProdutoConst::DAO);
        return $dao->findAll();
    }
}