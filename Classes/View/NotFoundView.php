<?php
namespace F2\Base\View;

/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 30/10/11
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */

class NotFoundView extends \TYPO3\FLOW3\MVC\View\NotFoundView {
    protected function getTemplatePathAndFilename() {
        return FLOW3_PATH_PACKAGES . 'Application/F2.Base/Resources/Private/Error/NotFoundView_Template.html';
    }

}
