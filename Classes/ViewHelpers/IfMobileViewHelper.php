<?php
namespace F2\Base\ViewHelpers;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 5/11/11
 * Time: 18:37
 * To change this template use File | Settings | File Templates.
 */
 class IfMobileViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractConditionViewHelper {

	/**
	 * renders <f:then> child if mobile is true, otherwise renders <f:else> child.
	 *
	 * @return string the rendered string
	 * @api
	 */
	public function render() {
        $isMobile =  \F2\Base\Service\MobileUtilsService::isMobileBrowser($_SERVER['HTTP_USER_AGENT']);
		if ($isMobile) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
}
