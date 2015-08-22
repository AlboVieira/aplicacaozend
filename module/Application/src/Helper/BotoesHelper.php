<?php

namespace Application\Helper;

/**
 * Created by PhpStorm.
 * User: albov
 * Date: 21/08/2015
 * Time: 21:46
 */
class BotoesHelper
{

    public static function addBotao(array $botao)
    {
        $texto = $botao['texto'];
        $link = $botao['link'];

        return <<<EOF
            <button class='btn-primary btn-small' data-href='$link'>
            $texto
            </button>
        "
EOF;
    }

}