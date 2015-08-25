<?php

namespace Application\Constants;

/**
 * Interface FormConst.
 */
interface PedidoConst
{
    const DAO = 'PedidoDao';
    const SERVICE = 'PedidoService';

    const FLD_ID_PEDIDO = 'idPedido';
    const LBL_ID_PEDIDO = 'Id';

    const FLD_DESCRICAO = 'descricao';
    const LBL_DESCRICAO = 'Descricao';


    const FLD_DATA = 'data';
    const LBL_DATA = 'Data';

    const FLD_VALOR_TOTAL = 'valorTotal';
    const LBL_VALOR_TOTAL = 'Valor Pedido';

    const FLD_PRODUTO = 'idProduto';
    const LBL_PRODUTO = 'Produto';

    const FLD_FORNECEDOR = 'idFornecedor';
    const LBL_FORNECEDOR = 'Fornecedor';

    const FLD_QTD = 'quantidade';
    const LBL_QTD = 'Quantidade';

    const FLD_UNIDADE = 'unidade';
    const LBL_UNIDADE = 'Unidade';
}
