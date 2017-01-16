<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\View\Helper;

use WellCart\Utility\Arr;
use WellCart\Utility\Valid;
use Zend\View\Helper\AbstractHelper;

class JavaScriptEnvironment extends AbstractHelper
{

    /**
     * @var array
     */
    protected $items = [];

    /**
     * Retrieve placeholder for constant element and optionally set state
     *
     * @param string $var
     * @param string $value
     *
     * @return JavaScriptEnvironment
     */
    public function __invoke($var = null, $value = null)
    {
        $var = (string)$var;
        $value = (string)$value;
        if ($var !== '' && $value !== '') {
            $this->set($var, $value);

        }

        return $this;
    }

    /**
     * @param $var
     * @param $value
     *
     * @return JavaScriptEnvironment
     */
    public function set($var, $value)
    {
        $this->items[$var] = $value;

        return $this;
    }

    /**
     * @param        $var
     * @param  mixed $default (optional) Default return value
     *
     * @return mixed
     */
    public function get($var, $default = null)
    {
        return Arr::get($this->items, $var, $default);
    }

    /**
     * Clear all items
     *
     * @return JavaScriptEnvironment
     */
    public function clear()
    {
        $this->items = [];

        return $this;
    }

    /**
     * Turn helper into string
     *
     * @return string
     */
    public function __toString()
    {
        try {

            if (!count($this->items)) {
                return '';
            }
            $output = "var ENV = \n";
            foreach ($this->items as $var => &$value) {
                $value = (Valid::digit($value)) ? doubleval($value) : $value;
            }

            $output .= json_encode($this->items) . ";\n";

            return "\n\t<script type=\"text/javascript\">
            \n" . $output . "</script>\n";
        }
        catch (\Throwable $e) {
            $msg = get_class($e) . ': ' . $e->getMessage();
            trigger_error($msg, E_USER_ERROR);

            return '';
        }
    }
}