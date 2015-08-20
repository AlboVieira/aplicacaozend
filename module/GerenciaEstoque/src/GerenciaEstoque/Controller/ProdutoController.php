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
use GerenciaEstoque\Service\ProdutoService;
use Zend\View\Model\ViewModel;

class ProdutoController extends ActionControllerAbstract
{
    public function indexAction()
    {
        /** @var ProdutoService $service */
        $service = $this->getFromServiceLocator('ProdutoService');

        $grid = $service->getGrid();


        return new ViewModel(
            array('grid' => $grid->renderJs())
        );
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


}
