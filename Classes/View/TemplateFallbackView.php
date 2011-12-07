<?php
namespace F2\Base\View;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 6/11/11
 * Time: 0:00
 * To change this template use File | Settings | File Templates.
 */

class TemplateFallbackView extends \TYPO3\Fluid\View\TemplateView {
    private $preferredFormat = '';

    protected function expandGenericPathPattern($pattern, $bubbleControllerAndSubpackage, $formatIsOptional)
    {
        $result =  parent::expandGenericPathPattern($pattern, $bubbleControllerAndSubpackage, $formatIsOptional);
        if ($this->getPreferredFormat()) {
            $topElement = array_pop($result);
            array_unshift($result,$topElement);
            $pos = strrpos($topElement,'.');
            if (substr_count($topElement,'.') > 1) {
                $template = substr($topElement,0,$pos). '.' . $this->getPreferredFormat();
            } else {
                $template = $topElement . '.' . $this->getPreferredFormat();
            }
            array_unshift($result,$template);
        }

       
       return $result;

    }

    public function setPreferredFormat($preferredFormat)
    {
        $this->preferredFormat = $preferredFormat;
    }

    public function getPreferredFormat()
    {
        return $this->preferredFormat;
    }

}
