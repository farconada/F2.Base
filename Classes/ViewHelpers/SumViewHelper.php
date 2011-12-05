<?php
namespace F2\Base\ViewHelpers;

class SumViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var boolean
	 */
	protected $escapingInterceptorEnabled = FALSE;

	/**
	 * Sum the items of a given property.
	 *
     * @param string nombre la property a sumar
	 * @param array $subject The array or ObjectStorage to iterated over
	 * @return float El total calculado
	 * @api
	 */
	public function render($property, $subject = NULL) {
		if ($subject === NULL) {
			$subject = $this->renderChildren();
		}
        $total = 0;
        $getter = 'get' . ucfirst($property);
        foreach ($subject as $obj) {
            $total = $total + floatval($obj->$getter());
        }
        return $total;

    }
}

?>
