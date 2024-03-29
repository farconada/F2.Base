<?php
namespace F2\Base\Annotations;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Doctrine\Common\Annotations\Annotation as DoctrineAnnotation;

/**
 * @Annotation
 * @DoctrineAnnotation\Target({"PROPERTY","CLASS"})
 */
final class Index {

	/**
	 * tipo de indice (text|keyword|unstored|date).
	 * @var string
	 */
	public $type;

	/**
	 * Options for the validator, validator-specific.
	 * @var array
	 */
	public $boost = 1;

    /**
     * El contenido es HTML?
     * @var bool
     */
    public $html = FALSE;

    public $defaultField = FALSE;

}

?>