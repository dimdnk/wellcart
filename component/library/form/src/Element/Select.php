<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Element;

use Zend\Form\Element\Select as SelectElement;

class Select extends SelectElement
{

    use SetValueObjectTrait;

    /**
     * @return array
     */
    public function getInputSpecification()
    {
        $inputSpecification = parent::getInputSpecification();
        $inputSpecification['required'] = isset($this->attributes['required'])
            && $this->attributes['required'];

        return $inputSpecification;
    }

    /**
     * Disable internal validator
     *
     * @return void
     */
    public function disableValidator()
    {
        $this->setDisableInArrayValidator(true);
        $this->validator = null;
    }
}