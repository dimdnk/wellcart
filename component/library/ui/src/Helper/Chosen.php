<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Chosen view helper
 */
class Chosen extends AbstractHelper
{
    protected $format = '$("%s").chosen(%s);';

    /**
     * @param  string $element
     * @param  array  $options
     *
     * @return string|Chosen
     */
    public function __invoke($element = null, array $options = [])
    {
        if ($element) {
            return $this->render($element, $options);
        }
        return $this;
    }

    /**
     * @param  string $element
     * @param  array  $options
     *
     * @return string
     */
    public function render($element, $options = [])
    {
        $chosenOptions = '';
        if (count($options) > 0) {
            $chosenOptions = '{';
            $first = true;
            foreach ($options as $key => $value) {
                if (!$first) {
                    $chosenOptions .= ', ';
                }
                if (is_numeric($value)) {
                    $chosenOptions .= "$key: $value";
                } else {
                    $chosenOptions .= "$key: '$value'";
                }
                if ($first) {
                    $first = false;
                }
            }
            $chosenOptions .= '}';
        }

        return sprintf($this->format, $element, $chosenOptions);
    }
}
