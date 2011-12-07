<?php
namespace F2\Base\RoutePartHandlers;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 7/11/11
 * Time: 17:30
 * To change this template use File | Settings | File Templates.
 */
 
class FileRoutePartHandler extends  \TYPO3\FLOW3\MVC\Web\Routing\DynamicRoutePart{
    protected function findValueToMatch($routePath)
    {
        $matches = array();
        preg_match('/^[a-z0-9\/]+[a-z0-9]\.[a-z]{1,5}$/i', $routePath, $matches);
        $result = (count($matches) === 1) ? current($matches) : '';
        return $result;
    }

}
