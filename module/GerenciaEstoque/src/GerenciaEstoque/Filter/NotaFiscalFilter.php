<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 22/08/2015
 * Time: 16:35
 */

namespace GerenciaEstoque\Filter;


use Application\Constants\NotaFiscalConst;
use Zend\InputFilter\InputFilter;

class NotaFiscalFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => NotaFiscalConst::FLD_PEDIDO,
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'campo' => NotaFiscalConst::LBL_PEDIDO,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_NUMERO_NOTA,
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'campo' => NotaFiscalConst::LBL_NUMERO_NOTA,
                    ),
                ),
            )
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_DATA,
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'campo' => NotaFiscalConst::FLD_DATA,
                    ),
                ),
            )
        ));


    }
}