<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRange;

class FormDateRange extends FormRange
{

    /**
     * Determine input type to use
     *
     * @param  ElementInterface $element
     *
     * @return string
     */
    protected function getType(ElementInterface $element)
    {
        return 'daterange';
    }
}