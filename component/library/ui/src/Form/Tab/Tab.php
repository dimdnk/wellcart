<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Form\Tab;

use WellCart\Utility\Arr;
use Zend\Stdlib\PriorityList;

class Tab extends PriorityList
{

    protected $id;

    protected $label;

    protected $attributes = [];

    protected $options = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Tab
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return Tab
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     *
     * @return Tab
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttribute($attr)
    {
        return Arr::get($this->attributes, $attr);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return Tab
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }


    /**
     * @param $option
     * @param $value
     *
     * @return $this
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * @param $attr
     * @param $value
     *
     * @return $this
     */
    public function setAttribute($attr, $value)
    {
        $this->attributes[$attr] = $value;

        return $this;
    }

    /**
     * @param $option
     *
     * @return mixed
     */
    public function getOption($option)
    {
        return Arr::get($this->options, $option);
    }

    /**
     * Insert a new item.
     *
     * @param  string $name
     * @param  mixed  $value
     * @param  int    $priority
     *
     * @return Tab
     */
    public function add($name, $value, $priority = 0)
    {
        $this->insert($name, $value, $priority);

        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     *
     * @return Tab
     */
    public function setItems(array $items)
    {
        foreach ($items as $key => $item) {
            $this->insert($key, $item);
        }

        return $this;

    }


}