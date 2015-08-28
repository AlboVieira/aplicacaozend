<?php

namespace Application\Constants;

/**
 * Interface FormConst.
 */
interface EstoqueConst
{
    const DAO = 'EstoqueDao';
    const SERVICE = 'EstoqueService';

    const FLD_ID_ESTOQUE = 'id';
    const LBL_ID_ESTOQUE = 'Id';


    const FLD_ID_PRODUTO = 'idProduto';
    const LBL_ID_PRODUTO = 'Produto';

    const FLD_QTD_PRODUTO = 'quantidade_estoque';
    const LBL_QTD_PRODUTO = 'Quantidade Estoque';

    const FLD_NOTA = 'idNotaFiscal';
    const LBL_NOTA = 'Nota Fiscal';

    const FLD_PRODUTO_ESTOQUE_MEDIA = 'media';
    const LBL_PRODUTO_ESTOQUE_MEDIA = 'Media de gasto por produto';
}

