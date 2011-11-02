<?php
namespace F2\Base\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "F2.Base".                    *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use F2\Base\Exception\BaseException as BaseException;
/**
 * Standard controller for the F2.Base package 
 *
 * @FLOW3\Scope("singleton")
 */
class BaseController extends \TYPO3\FLOW3\MVC\Controller\ActionController {

    private $ABTestEnabled = FALSE;
    private $alternativeTemplatesPath;
    private $alternativePartialsPath;
    private $alternativeLayoutsPath;

	/**
	 * Index action
	 *
	 * @return void
	 */
	 public function mapSettings(array $settings) {
        $this->ABTestEnabled = $settings['ABTest']['enabled'] == 'y' ? TRUE: FALSE;
        $this->alternativeTemplatesPath = $this->settings['ABTest']['AlternativeTemplatesPath'];
        $this->alternativeLayoutsPath = $this->settings['ABTest']['AlternativeLayoutsPath'];
        $this->alternativePartialsPath = $this->settings['ABTest']['AlternativePartialsPath'];

    }

    /**
	 *
	 * @param \TYPO3\FLOW3\MVC\View\ViewInterface $view La vista
	 * @return void
	 */
	protected function initializeView(\TYPO3\FLOW3\MVC\View\ViewInterface $view) {
        /**
         * @var TYPO3\FLOW3\MVC\Web\Request $requestArguments
         */
        $requestArguments = $this->controllerContext->getRequest()->getArguments();
        if($this->ABTestEnabled && isset($requestArguments['bversion']) && $requestArguments['bversion']=='1' && $view instanceof \TYPO3\Fluid\View\TemplateView ) {
            /**
             * @var $view  \TYPO3\Fluid\View\TemplateView
             */
            $view->setTemplateRootPath($this->alternativeTemplatesPath);
            $view->setLayoutRootPath($this->alternativeLayoutsPath);
            $view->setPartialRootPath($this->alternativePartialsPath);
        } else {
            parent::initializeView($view);
        }
	}

    /**
	 * Utilizado para capturar las excepciones de las Actions
	 *
	 * @param \TYPO3\FLOW3\MVC\RequestInterface $request
	 * @param \TYPO3\FLOW3\MVC\ResponseInterface $response
	 * @return void
	 */
	public function processRequest(\TYPO3\FLOW3\MVC\RequestInterface $request, \TYPO3\FLOW3\MVC\ResponseInterface $response) {
		try {
			parent::processRequest($request, $response);
		} catch (BaseException $exception) {
			$this->redirect('exceptionHandler','standard' , NULL, array('exception' => $exception->getMessage()));
		}
	}

    /**
     * Action para mostrar errores controlados
     *
     * @param string $exception
     * @return void
     */
    public function exceptionHandlerAction($exception) {
        $this->view->assign('exception',$exception);
    }

    /**
	 * Funcion a ejecutar antes de cualquier action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		parent::initializeAction();
        $this->mapSettings($this->settings);
	}

}

?>