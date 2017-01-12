<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\View\Helper;

use Zend\Form\Element\Checkbox;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormLabel as Label;

class FormLabel extends Label
{

    /**
     * @inheritdoc
     */
    public function openTag($attributesOrElement = null)
    {
        $label = parent::openTag($attributesOrElement);
        $isRequired = false;
        if ($attributesOrElement instanceof ElementInterface) {
            $isRequired = (bool)$attributesOrElement->getAttribute('required');
        } elseif (!empty($attributesOrElement['class'])
            && strpos($attributesOrElement['class'], 'required') !== false
        ) {
            $isRequired = true;
        }
        if ($isRequired && (!$attributesOrElement instanceof Checkbox)) {
            $label .= '<span class="required"><small>*</small></span> ';
        }

        return $label;
    }
}