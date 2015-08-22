<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:52
 */
namespace Application\Util;

use Doctrine\ORM\QueryBuilder;

class JqGridTable
{
    /*$("#jqGrid").jqGrid({
            url: '/gerencia-estoque/produto',
            mtype: "GET",
            styleUI : 'Bootstrap',
            datatype: "jsonp",
            colModel: [
                { label: 'ID', name: 'id', key: true, width: 75 },
                { label: 'Descricao', name: 'nome', width: 150 },
                { label: 'Valor Unitario', name: 'Valor', width: 150 },
            ],
            viewrecords: true,
            height: 250,
            rowNum: 20,
            pager: "#jqGridPager"
        });*/
    private $title;
    private $colunas = array();
    private $url;
    private $widthTable = 1000;

    private $rowNum;
    private $queryBuilder;

    private $alias;

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

    public function getTodosRegistros()
    {
        $qb = clone $this->queryBuilder;

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
            'rows' => $this->getTodosRegistros(),
            'total' => $qtde,
            'records' => $qtde,
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


    public function getParametrosFromPost()
    {
        /*
        $parametros = array();

        if (isset($_GET[])) {
            $parametros[self::PARAM_COLUNAS] = $_GET[self::PARAM_COLUNAS];
        }
        */
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
            });
        });
        </script>
EOF;
    }

}