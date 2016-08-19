<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Datagrid;

class ToolbarButton
{
    /**
     * @var string
     */
    protected $label = '';
    /**
     * @var string
     */
    protected $name = '';
    /**
     * @var string
     */
    protected $class = '';
    /**
     * @var string
     */
    protected $icon = '';
    /**
     * @var string
     */
    protected $link = '';

    /**
     * @return string
     */
    public function getLabel():string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return Button
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getClass():string
    {
        return $this->class;
    }

    /**
     * @param string $class
     *
     * @return Button
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon():string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return Button
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink():string
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @return Button
     */
    public function setLink(string $link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Button
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }


}