<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Element;

use Zend\Form\Element\Range;

class DateRange extends Range
{
    use SetValueObjectTrait;
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes
        = [
            'type' => 'daterange',
        ];

    /**
     * @var array custom options
     */
    protected $options
        = [
            'add-on-append' => '<i class="fa fa-calendar"></i>',
        ];

}