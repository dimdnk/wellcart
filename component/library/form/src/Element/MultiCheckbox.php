<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\Element;

use Zend\Form\Element\MultiCheckbox as MultiCheckboxElement;

class MultiCheckbox extends MultiCheckboxElement
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