<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\JsValidation\Renderer;

use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    /**
     * True merging of two arrays, as opposed to PHPs default array_merge_recursive,
     * which doesn't do true merging of array keys
     *
     * @param array $a The original array
     * @param array $b The array to merge
     *
     * @return array
     */
    public function mergeRecursive(array $a, array $b)
    {
        $merged = $a;

        if (is_array($b)) {
            foreach ($b as $key => $val) {
                if (is_array($b[$key])) {
                    if (isset($merged[$key])) {
                        $merged[$key] = is_array($merged[$key]) ? $this->mergeRecursive($merged[$key], $b[$key]) : $b[$key];
                    } else {
                        $merged[$key] = $b[$key];
                    }
                } else {
                    $merged[$key] = $val;
                }
            }
        }

        return $merged;
    }
}
