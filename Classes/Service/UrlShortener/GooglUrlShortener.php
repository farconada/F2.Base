<?php
namespace F2\Base\Service\UrlShortener;
use TYPO3\FLOW3\Annotations as FLOW3;
require_once FLOW3_PATH_PACKAGES . 'Application/F2.Base/Resources/Private/PHP/Googl/Googl.php';
/**
 * @author Fernando Arconada fernando.arconada@gmail.com
 * Date: 14/10/11
 * Time: 11:17
 */
/**
 * Acortador de URL de google
 *
 * @FLOW3\Scope("singleton")
 */
class GooglUrlShortener implements UrlShortenerInterface
{
    private $googl;

    /**
     * Devuelve una url corta a partir de una larga
     *
     * @param $longUrl
     * @return string
     */
    public function getShort($longUrl)
    {
        $urlArray = $this->googl->set_short($longUrl);
        return $urlArray['id'];
    }

    /**
     * Devuelve una url larga a partir de una corta y sus analytics
     *
     * @param $shortUrl
     * @return array
     */
    public function getLong($shortUrl)
    {
        $this->googl->get_long($shortUrl,true);
    }

    /**
     * @param $apikey string
     */
    public function __construct($apikey)
    {
        $this->googl = new \Googl($apikey);
    }

}
