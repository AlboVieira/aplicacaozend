<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:52
 */
namespace Application\Util;

use Application\Constants\JqGridConst;
use Doctrine\ORM\QueryBuilder;

class JqGridTable
{
    private $title;
    private $colunas = array();
    private $url;
    private $widthTable = 1120;

    private $queryBuilder;
    private $alias;

    private $offset = 0;
    private $qtdRegistrosPaginados;

    private $rows;
    private $page;


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAlias($alias){
        $this->alias = $alias;
    }

    public function setWidth($width){
        $this->widthTable = $width;
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function addColunas($coluna){
        array_push($this->colunas, $coluna);
    }

    public function getColunas(){

        return json_encode($this->colunas);
    }

    public function setQuery(QueryBuilder $qb){
        $this->queryBuilder = $qb;
        return $this;
    }

    /*public function setQueryOrder(){
        foreach ($this->ordenacao as $campo => $direcao) {
            $campoOrderExpr = $this->colunas[$campo][self::PARAM_COLUNAS_DATA];
            $campoOrderExpr = str_replace('\\', '', $campoOrderExpr);

            if (isset($this->ordenacaoReplace[$campoOrderExpr])) {
                $campoOrderExpr = $this->ordenacaoReplace[$campoOrderExpr];
            } else {
                $campoOrderExpr = "LOWER($campoOrderExpr)";
            }

            $campoOrderAlias = 'order_'.$this->getRandomName(self::RANDOM_LENGTH);

            $qb->addSelect($campoOrderExpr.' as '.$campoOrderAlias);
            $qb->addOrderBy($campoOrderAlias, $direcao);
        }

        return $qb;
    }*/

    public function getTodosRegistros()
    {
        $qb = clone $this->queryBuilder;

        $this->setQueryOffset($qb);

        $results = $qb
            ->getQuery()
            ->getResult();

        //$this->lastQuery = $qb->getQuery()->getSQL();

        return $results;
    }

    public function getRegistrosPaginados()
    {
        $qb = clone $this->queryBuilder;

        $this->setQueryOffset($qb);

        $results = $qb
            ->getQuery()
            ->getResult();

        //$this->lastQuery = $qb->getQuery()->getSQL();

        return $results;
    }

    public function getDatatableArray()
    {
        $qtde = $this->getCount();

        return array(
            JqGridConst::PARAM_REGISTROS => $this->getRegistrosPaginados(),
            JqGridConst::PARAM_QTD_TOTAL => $qtde,
            JqGridConst::PARAM_REGISTRO_ENCONTRADOS => $qtde,
        );
    }

    public function getCount()
    {
        $qb = clone $this->queryBuilder;

        $results = $qb
            ->select('COUNT('.$this->alias.')')
            ->getQuery()
            ->getSingleScalarResult();

        //$this->lastQuery = $qb->getQuery()->getSQL();

        return $results;
    }


    private function setQueryOffset(&$qb)
    {
        $qb->setFirstResult($this->offset);
        $qb->setMaxResults($this->qtdRegistrosPaginados);

        return $qb;
    }

    public function setParametrosRequest()
    {

        if (isset($_GET['rows'])) {
            $this->qtdRegistrosPaginados = $_GET['rows'];
        }
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }

        if ($this->page > 1) {
            $this->offset = ($this->page - 1) * $this->qtdRegistrosPaginados;
        }

    }

    public function renderJs(){

        $colunas = $this->getColunas();
        return <<<EOF

        <div style="margin-left:20px">
            <table id="jqGrid"></table>
            <div id="jqGridPager"></div>
        </div>

        <script>
        $(document).ready(function () {
            //$.jgrid.no_legacy_api = true;
            //$.jgrid.useJSON = true;
            $.jgrid.defaults.width = $this->widthTable;
            $("#jqGrid").jqGrid({
                url: '$this->url',
                mtype: "GET",
                styleUI : 'Bootstrap',
                datatype: "json",
                colModel: $colunas,
                viewrecords: true,
                height: 250,
                rowNum: 10,
                pager: "#jqGridPager",
                caption: "<h4><b>$this->title</b></h4>",
                jsonReader: {repeatitems: false},
                autoWidth:true,
                postData:{myname:'teste'},
                //shrink:true
            });
        });
        </script>
EOF;
    }

}