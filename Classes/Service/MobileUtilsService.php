<?php
namespace F2\Base\Service;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * @author Fernando Arconada fernando.arconada@gmail.com
 * Date: 14/10/11
 * Time: 11:17
 */
/**
 * Clase de utilidades relacionadas con dispositivos moviles
 *
 * @FLOW3\Scope("singleton")
 */
class MobileUtilsService {
    public static function isMobileBrowser($userAgent) {
        $isMobile = preg_match('/(iPhone|IEMobile|Windows CE|NetFront|PlayStation|PLAYSTATION|like Mac OS X|MIDP|UP\.Browser|Symbian|Nintendo|Android)/', $userAgent);
        return $isMobile > 0;
    }
}