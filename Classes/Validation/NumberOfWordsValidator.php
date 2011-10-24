<?php
namespace F2\Base\Validation;
use TYPO3\FLOW3\Annotations as FLOW3;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 12/10/11
 * Time: 22:51
 * To change this template use File | Settings | File Templates.
 */
 
class NumberOfWordsValidator  extends \TYPO3\FLOW3\Validation\Validator\AbstractValidator {

    /**
     * Check if $value is valid. If it is not valid, needs to add an error
     * to Result.
     *
     * @return void
     */
    protected function isValid($value)
    {
        $numberOfWords = count(explode(' ',$value));
        if ($numberOfWords > $this->options['max'] ) {
            $this->addError("Ha execedido el numero maximo de palabras,${numberOfWords}palabras",1318453333);
        }
    }

}
