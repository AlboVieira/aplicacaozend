<?php

namespace GerenciaEstoque\Form;

use Application\Constants\NotaFiscalConst;
use Application\Constants\PedidoConst;
use GerenciaEstoque\Entity\NotaFiscal;
use GerenciaEstoque\Service\NotaFiscalService;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Class ProdutoForm.
 */
class NotaFiscalForm extends Form
{
    /**
     * Cria o formulario para grupo.
     */
    public function __construct(NotaFiscalService $service, $url = null)
    {
        parent::__construct('nota_fiscal_form');

        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new NotaFiscal());

        $this->setAttributes(array(
            'method' => 'post',
            'action' => $url,
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_ID_NOTA_FISCAL,
            'attributes' => array(
                'type' => 'hidden',
                'class' => '',
            ),
            'options' => array(
                'label' => '',
            ),
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_DATA,
            'attributes' => array(
                'type' => 'Date',
                'class' => '',
            ),
            'options' => array(
                'label' => NotaFiscalConst::LBL_DATA,
            ),
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_NUMERO_NOTA,
            'attributes' => array(
                'type' => 'number',
                'class' => '',
            ),
            'options' => array(
                'label' => NotaFiscalConst::LBL_NUMERO_NOTA,
            ),
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_PEDIDO,
            'attributes' => array(
                'type' => 'number',
                'class' => '',
            ),
            'options' => array(
                'label' => NotaFiscalConst::LBL_PEDIDO,
            ),
        ));

        $this->add(array(
            'name' => NotaFiscalConst::FLD_PEDIDO,
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => '',
            ),
            'options' => array(
                'label' => NotaFiscalConst::LBL_PEDIDO,
                'empty_option' => 'Selecione',
                'value_options' =>
                    $service->montarArrayNomeadoSelect(
                        $service->getPedidos(),
                        PedidoConst::FLD_ID_PEDIDO,
                        PedidoConst::FLD_ID_PEDIDO

                    ),
                'disable_inarray_validator' => true,
            ),
        ));


        $this->add(array(
            'name' => 'btn_salvar',
            'type' => 'button',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Salvar',
                'id' => 'salvar_' . $this->getName(),
                'class' => 'btn-primary btn-white width-25 btn',
                'style' => '',
            ),
            'options' => array(
                'label' => 'Salvar',
                'glyphicon' => 'glyphicon glyphicon-floppy-disk blue',
            ),

        ));

        $this->add(array(
            'name' => 'btn_cancelar',
            'type' => 'button',
            'attributes' => array(
                'type' => 'reset',
                'value' => 'Cancelar',
                'id' => 'cancelar_' . $this->getName(),
                'class' => 'btn-danger btn-white margin-left-right-10px width-25 btn',
            ),
            'options' => array(
                'label' => 'Cancelar',
                'glyphicon' => 'glyphicon glyphicon-remove red',
            ),
        ));

    }
}
