<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Button view helper styled for Bootstrap 3
 */
class Button extends AbstractHelper
{
    const TYPE_BUTTON = 0;

    const TYPE_ANCHOR = 1;

    const TYPE_INPUT = 2;

    protected $formatButton = '<button type="button" class="btn %s"%s>%s</button>';

    protected $formatAnchor = '<a href="%s" role="button" class="btn %s"%s>%s</a>';

    protected $formatInput = '<input type="%s" value="%s" class="btn %s"%s>';

    protected $type = self::TYPE_BUTTON;

    protected $value = null;

    protected $size = null;

    protected $isBlock = false;

    protected $isActive = false;

    protected $isDisabled = false;

    protected $anchor = '#';

    protected $anchorTarget = null;

    protected $inputType = 'button';

    protected $id = null;

    protected $name = null;


    /**
     * @param string $anchor
     * @param null   $target
     *
     * @return Button
     */
    public function asAnchor($anchor = '#', $target = null)
    {
        $this->type = self::TYPE_ANCHOR;
        $this->anchor = $anchor;
        $this->anchorTarget = $target;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return Button
     */
    public function asInput($type = 'button')
    {
        if ($type != 'button' && $type != 'submit' && $type != 'reset') {
            throw new \InvalidArgumentException(
                'Input type must be "button", "submit" or "reset"'
            );
        }
        $this->type = self::TYPE_INPUT;
        $this->inputType = $type;

        return $this;
    }

    /**
     * @return Button
     */
    public function asButton()
    {
        $this->type = self::TYPE_BUTTON;

        return $this;
    }

    /* Color methods */
    public function useDefault($value, $style = null)
    {
        return $this->render($value, 'btn-default', $style);
    }

    /**
     * @param        $value
     * @param string $class
     * @param null   $style
     *
     * @return string
     */
    public function render($value, $class = 'btn-default', $style = null)
    {
        $class = trim($class);

        $extra = '';
        if ($this->isDisabled) {
            $extra .= ' disabled="disabled"';
        }
        if ($this->id !== null) {
            $extra .= ' id="' . $this->id . '"';
        }
        if ($this->name !== null) {
            $extra .= ' name="' . $this->name . '"';
        }
        if ($style !== null) {
            $extra .= ' style="' . $style . '"';
        }

        if ($this->isActive) {
            $class .= ' active';
        }
        if ($this->isBlock) {
            $class .= ' btn-block';
        }
        if ($this->size !== null) {
            $class .= ' ' . $this->size;
        }

        if ($this->type == self::TYPE_ANCHOR) {
            if ($this->anchorTarget !== null) {
                $extra .= ' target="' . $this->anchorTarget . '"';
            }

            return sprintf(
                $this->formatAnchor, $this->anchor, $class, $extra, $value
            );
        } elseif ($this->type == self::TYPE_INPUT) {
            return sprintf(
                $this->formatInput, $this->inputType, $value, $class, $extra
            );
        } else {
            return sprintf($this->formatButton, $class, $extra, $value);
        }
    }

    /**
     * @param      $value
     * @param null $style
     *
     * @return string
     */
    public function primary($value, $style = null)
    {
        return $this->render($value, 'btn-primary', $style);
    }

    /**
     * @param      $value
     * @param null $style
     *
     * @return string
     */
    public function success($value, $style = null)
    {
        return $this->render($value, 'btn-success', $style);
    }

    /**
     * @param      $value
     * @param null $style
     *
     * @return string
     */
    public function info($value, $style = null)
    {
        return $this->render($value, 'btn-info', $style);
    }

    /**
     * @param      $value
     * @param null $style
     *
     * @return string
     */
    public function warning($value, $style = null)
    {
        return $this->render($value, 'btn-warning', $style);
    }

    /**
     * @param      $value
     * @param null $style
     *
     * @return string
     */
    public function danger($value, $style = null)
    {
        return $this->render($value, 'btn-danger', $style);
    }

    /**
     * @param      $value
     * @param null $style
     *
     * @return string
     */
    public function link($value, $style = null)
    {
        return $this->render($value, 'btn-link', $style);
    }

    /**
     * @return Button
     */
    public function setLarge()
    {
        $this->size = 'btn-lg';

        return $this;
    }

    /**
     * @return Button
     */
    public function setSmall()
    {
        $this->size = 'btn-sm';

        return $this;
    }

    /* Block method */

    public function setExtraSmall()
    {
        $this->size = 'btn-xs';

        return $this;
    }

    /* Active method */

    public function isBlock($block = true)
    {
        if (!is_bool($block)) {
            $block = false;
        }
        $this->isBlock = $block;

        return $this;
    }

    /**
     * @param bool|true $active
     *
     * @return Button
     */
    public function isActive($active = true)
    {
        if (!is_bool($active)) {
            $active = false;
        }
        $this->isActive = $active;

        return $this;
    }

    public function isDisabled($disabled = true)
    {
        if (!is_bool($disabled)) {
            $disabled = false;
        }
        $this->isDisabled = $disabled;

        return $this;
    }

    /**
     * @param $value
     *
     * @return Button
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param $name
     *
     * @return Button
     **/

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param null   $value
     * @param string $class
     * @param null   $style
     *
     * @return Button|string
     */
    public function __invoke($value = null, $class = 'default', $style = null)
    {
        if ($value) {
            return $this->render($value, "btn-$class", $style);
        }

        return $this;
    }
}