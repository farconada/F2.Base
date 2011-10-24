<?php
namespace F2\Base\ViewHelpers;
use TYPO3\FLOW3\Annotations as FLOW3;
require_once FLOW3_PATH_PACKAGES . 'Application/F2.Base/Resources/Private/PHP/recaptcha/recaptchalib.php';
/**
 * @FLOW3\Scope("singleton")
 */
class RecaptchaViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var boolean
	 */
	protected $escapingInterceptorEnabled = FALSE;

    private $publickey;

	/**
	 *
	 * @param string $publickey
	 * @return string
	 */
	public function render($publickey='') {
        if($publickey){
            return recaptcha_get_html($publickey);
        } else {
          return recaptcha_get_html($this->publickey);
        }

	}

    public function __construct($publickey) {
        $this->publickey = $publickey;
    }
}

?>
