<?php
namespace F2\Base\Service\Mail;
use TYPO3\FLOW3\Annotations as FLOW3;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 17/11/11
 * Time: 18:50
 * To change this template use File | Settings | File Templates.
 */

/**
 * Servicio de envio de Mails
 *
 * @FLOW3\Scope("singleton")
 */
class SwiftMailerService implements  MailerServiceInterface {
    /**
	 * @FLOW3\Inject
	 * @var \TYPO3\SwiftMailer\MailerInterface
	 */
	protected $mailer;

    public function sendMail($aTo, $aFrom, $aSubject, $aBody,$format) {
        $message = new \TYPO3\SwiftMailer\Message();
		$message->setFrom($aFrom)
				->setTo($aTo)
				->setSubject($aSubject)
				->setBody($aBody)
                ->setContentType($format);;
		$this->mailer->send($message);
    }


}
