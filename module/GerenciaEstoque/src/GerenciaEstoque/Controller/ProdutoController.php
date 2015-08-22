<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GerenciaEstoque\Controller;

use Application\Constants\ProdutoConst;
use Application\Custom\ActionControllerAbstract;
use GerenciaEstoque\Filter\ProdutoFilter;
use GerenciaEstoque\Form\ProdutoForm;
use GerenciaEstoque\Service\ProdutoService;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ProdutoController extends ActionControllerAbstract
{
    public function indexAction()
    {
        /** @var ProdutoService $service */
        $service = $this->getFromServiceLocator(ProdutoConst::SERVICE);
        $grid = $service->getGrid();
        return new ViewModel(
            array(
                'grid' => $grid,
                'botoesHelper' => $this->getBotoesHelper()
            )
        );
    }

    public function getDadosAction(){

        /** @var ProdutoService $service */
        $service = $this->getFromServiceLocator(ProdutoConst::SERVICE);
        $grid = $service->getGridDados();

        return new JsonModel($grid);
    }

    public function incluirAction(){

        /** @var ProdutoService $service */
        $service = $this->getFromServiceLocator(ProdutoConst::SERVICE);

        $form = new ProdutoForm();
        $filter = new ProdutoFilter();

        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $form->setInputFilter($filter);
            $form->setData($post);

            if($form->isValid()){
                try{
                    if($service->salvar($form->getData())){
                        $this->flashMessenger()->addSuccessMessage('Cadastro realizado com sucesso');
                    }
                }
                catch(\Exception $e){
                    $this->flashMessenger()->addErrorMessage('Erro');
                }
            }

        }

        return new ViewModel(
            array(
                'form' => $form,
            )
        );
    }

    public function editarAction(){
        return new ViewModel();
    }

    public function excluirAction(){
        return new ViewModel();
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
            $this->addBotaoHelper('btn-incluir btn-success btn btn-xs', 'glyphicon glyphicon-plus', 'Incluir Produto','',
                $this->url()->fromRoute('produto', array('action' => 'incluir'))),
        );
    }

}
