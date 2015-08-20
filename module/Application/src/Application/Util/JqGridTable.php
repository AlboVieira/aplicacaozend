<?php

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 19/08/2015
 * Time: 23:52
 */
namespace Application\Util;

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

    private $colunas;
    private $url;
    private $widthTable = 1000;


    public function setWidth($width){
        $this->widthTable = $width;
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function createColunas($coluna){
        array_push($colunas, $coluna);
    }

    public function getColums($colunas){

    }

    public function renderJs(){
        return <<<EOF

        <div style="margin-left:20px">
            <table id="jqGrid"></table>
            <div id="jqGridPager"></div>
        </div>

        <script>
        $.jgrid.defaults.width = $this->widthTable;
        $("#jqGrid").jqGrid({
            url: '$this->url',
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
        });
        </script>
EOF;
    }

}