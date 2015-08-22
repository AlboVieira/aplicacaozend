<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GerenciaEstoque\Controller;

use Application\Custom\ActionControllerAbstract;
use Application\Helper\BotoesHelper;
use GerenciaEstoque\Service\ProdutoService;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ProdutoController extends ActionControllerAbstract
{
    public function indexAction()
    {
        /** @var ProdutoService $service */
        $service = $this->getFromServiceLocator('ProdutoService');

        $grid = $service->getGrid();
        //var_dump($grid);die;
        return new ViewModel(
            array(
                'grid' => $grid,
               // 'botoes' => $this->addBotao()
            )
        );
    }

    public function getDadosAction(){

        /** @var ProdutoService $service */
        $service = $this->getFromServiceLocator('ProdutoService');
        $grid = $service->getGridDados();

        return new JsonModel($grid);
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

    public function addBotao(){
        BotoesHelper::addBotao(array('Incluir', '/produto/incluir'));
    }

}
