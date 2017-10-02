<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Form\Element\Button;

use Zend\Form\Element\Button as BaseButton;

class Valid extends BaseButton
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'valid',
        'type' => 'submit',
    ];

    /**
     * @var string
     */
    protected $label = 'Valid';
}