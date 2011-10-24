<?php
namespace F2\Base\Service\UrlShortener;
use TYPO3\FLOW3\Annotations as FLOW3;
/**
 * @author Fernando Arconada fernando.arconada@gmail.com
 * Date: 14/10/11
 * Time: 11:15
 */
 
interface UrlShortenerInterface {
    /**
     * Devuelve una url corta a partir de una larga
     *
     * @abstract
     * @param $longUrl
     * @return string
     */
    public function getShort($longUrl);

    /**
     * Devuelve una url larga a partir de una corta
     *
     * @abstract
     * @param $shortUrl
     * @return string
     */
    public function getLong($shortUrl);
}