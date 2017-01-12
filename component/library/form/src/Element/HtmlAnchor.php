<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Element;

use WellCart\Utility\Arr;
use Zend\Form\Element as FormElement;

class HtmlAnchor extends \Zend\Form\Element
{

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes
        = [
            'type' => 'htmlanchor',
        ];

    /**
     * @return string
     */
    public function getText()
    {
        return Arr::get($this->options, 'text');
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return Arr::get($this->options, 'class');
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return Arr::get($this->options, 'target');
    }


    /**
     * @return string
     */
    public function getIcon()
    {
        return Arr::get($this->options, 'icon');
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return Arr::get($this->options, 'link');
    }
}
