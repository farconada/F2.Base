<?php
namespace F2\Base\Aspect;
use \F2\Base\Exception\BaseException;
use TYPO3\FLOW3\Annotations as FLOW3;
require_once FLOW3_PATH_PACKAGES . 'Application/F2.Base/Resources/Private/PHP/recaptcha/recaptchalib.php';
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 17/10/11
 * Time: 19:05
 * To change this template use File | Settings | File Templates.
 */
abstract class RecaptchaAbstractAspect {
    /**
	 * @var \TYPO3\FLOW3\Utility\Environment
	 * @FLOW3\Inject
	 */
	protected $environment;

    private $privatekey;


    abstract public function recaptchaRequiredActions();

    /**
     * @param \TYPO3\FLOW3\AOP\JoinPointInterface $joinPoint
     * @return void
     */
    public function validate(\TYPO3\FLOW3\AOP\JoinPointInterface $joinPoint){
        $arguments = $this->environment->getRawPostArguments();
        $resp = recaptcha_check_answer ($this->privatekey,
                                $_SERVER['REMOTE_ADDR'],
                                $arguments['recaptcha_challenge_field'],
                                $arguments['recaptcha_response_field']);
        if (!$resp->is_valid) {
            throw new BaseException('No valida el catcha, una persona seria capaz de hacerlo!',1318876339);
        }
    }

    public function __construct($privatekey) {
        $this->privatekey = $privatekey;
    }
}
