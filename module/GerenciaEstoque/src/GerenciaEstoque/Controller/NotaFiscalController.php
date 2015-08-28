<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GerenciaEstoque\Controller;

use Application\Constants\FornecedorConst;
use Application\Constants\MensagemConst;
use Application\Constants\NotaFiscalConst;
use Application\Constants\PedidoConst;
use Application\Custom\ActionControllerAbstract;
use GerenciaEstoque\Filter\NotaFiscalFilter;
use GerenciaEstoque\Form\NotaFiscalForm;
use GerenciaEstoque\Service\FornecedorService;
use GerenciaEstoque\Service\NotaFiscalService;
use GerenciaEstoque\Service\PedidoService;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class NotaFiscalController extends ActionControllerAbstract
{
    public function indexAction()
    {
        /** @var PedidoService $service */
        $service = $this->getFromServiceLocator(NotaFiscalConst::SERVICE);
        $grid = $service->getGrid();

        return new ViewModel(
            array(
                'grid' => $grid,
                'botoesHelper' => $this->getBotoesHelper()
            )
        );
    }

    public function getDadosAction()
    {

        /** @var NotaFiscalService $service */
        $service = $this->getFromServiceLocator(NotaFiscalConst::SERVICE);
        $grid = $service->getGridDados();

        return new JsonModel($grid);
    }

    public function incluirAction()
    {

        /** @var NotaFiscalService $service */
        $service = $this->getFromServiceLocator(NotaFiscalConst::SERVICE);

        $form = new NotaFiscalForm($service);

        if ($this->getRequest()->isPost()) {

            $filter = new NotaFiscalFilter();
            $post = $this->getRequest()->getPost();
            $form->setInputFilter($filter);
            $form->setData($post);

            if ($form->isValid()) {
                try {
                    if ($notaFiscal = $service->salvar($form->getData())) {
                        $this->flashMessenger()->addSuccessMessage(MensagemConst::CADASTRO_SUCESSO);
                        $this->redirect()->toRoute('nota-fiscal');
                        //$this->redirect()->toUrl('/nota-fiscal/editar/' . $notaFiscal->getIdNotaFiscal());
                    } else {
                        $this->flashMessenger()->addErrorMessage(MensagemConst::OCORREU_UM_ERRO);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage(MensagemConst::OCORREU_UM_ERRO);
                }
            }

        }

        $view = new ViewModel();
        $view->setTemplate('gerencia-estoque/nota-fiscal/formulario');
        $view->setVariables(array(
            'form' => $form,
        ));
        return $view;
    }

    public function editarAction()
    {

        /** @var NotaFiscalService $service */
        $service = $this->getFromServiceLocator(NotaFiscalConst::SERVICE);

        $form = new NotaFiscalForm($service);
        $filter = new NotaFiscalFilter();

        $id = $this->params()->fromRoute('id');
        $notaFiscal = $service->getEntity($id);

        //var_dump($pedido);die;
        $form->bind($notaFiscal);
        $form->get(PedidoConst::FLD_DATA)->setValue($notaFiscal->getData()->format('Y-m-d'));

        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $form->setInputFilter($filter);
            $form->setData($post);

            if ($form->isValid()) {
                try {
                    if ($service->salvar($form->getData())) {
                        $this->flashMessenger()->addSuccessMessage(MensagemConst::CADASTRO_SUCESSO);
                        $form->setData($post);
                        return $this->redirect()->toRoute('nota-fiscal');
                    } else {
                        $this->flashMessenger()->addErrorMessage(MensagemConst::OCORREU_UM_ERRO);

                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage(MensagemConst::OCORREU_UM_ERRO);
                }
            }

        }


        $view = new ViewModel();
        $view->setTemplate('gerencia-estoque/nota-fiscal/formulario');
        $view->setVariables(array(
            'form' => $form,
        ));
        return $view;
    }


    public function excluirAction()
    {
        /** @var FornecedorService $service */
        $service = $this->getFromServiceLocator(FornecedorConst::SERVICE);

        $id = $this->params()->fromRoute('id');
        try {
            if ($service->excluir($id)) {
                $this->flashMessenger()->addSuccessMessage(MensagemConst::EXCLUIR_SUCESSO);
            }
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage(MensagemConst::OCORREU_UM_ERRO);
        }

        return $this->redirect()->toRoute('fornecedor');
    }

    /**
     * Retorna o titulo da pagina (especializar)
     *
     * @return mixed
     */
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    /**
     * @return mixed
     */
    public function getBreadcrumb()
    {
        // TODO: Implement getBreadcrumb() method.
    }

    public function getBotoesHelper()
    {
        return array(
            $this->addBotaoHelper('btn-incluir btn-success btn btn-xs', 'glyphicon glyphicon-plus', 'Incluir Nota Fiscal', '',
                $this->url()->fromRoute('nota-fiscal', array('action' => 'incluir'))),
        );
    }


}
