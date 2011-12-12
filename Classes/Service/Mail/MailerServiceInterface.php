<?php
namespace F2\Base\Service\Mail;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 17/11/11
 * Time: 18:52
 * To change this template use File | Settings | File Templates.
 */
 
interface MailerServiceInterface {
    public function sendMail($aTo,$aFrom,$aSubject,$aBody,$format);
}
