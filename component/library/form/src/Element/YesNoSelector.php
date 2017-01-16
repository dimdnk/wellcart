<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Form\Element;

class YesNoSelector extends Select
{

    /**
     * @param  null|int|string $name    Optional name for the element
     * @param  array           $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->setEmptyOption('');
        $this->setValueOptions(
            [
                1 => __('Yes'),
                0 => __('No'),
            ]
        );
    }
}