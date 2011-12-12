<?php
namespace F2\Base\Service\Mail;
use F2\Base\Exception\GearmanException;
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
class GearmanMailerService implements  MailerServiceInterface {

    /**
     * @var \GearmanClient
     */
    private $gearmanClient;

    public function __construct($servers) {
        $this->gearmanClient = new \GearmanClient();
        foreach ($servers as $server){
            $port = isset($server['port'])? $server['port']: 4730;
            $this->gearmanClient->addServer($server['host'],$port);
        }
    }
    public function sendMail($aTo, $aFrom, $aSubject, $aBody,$format) {
        $jsonData = json_encode(array(
            'To'        => $aTo,
            'From'      => $aFrom,
            'Subject'   => $aSubject,
            'Body'      => $aBody,
            'Format'    => $format
        ));
        try{
            $this->gearmanClient->doBackground('F2API.mail',$jsonData);
        } catch (\Exception $ex) {
            throw new MailerException($ex->getMessage(),$ex->getCode());
        }

    }


}
