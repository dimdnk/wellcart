<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Utility;

/**
 * Utility methods for the boolean data type
 */
class Booleans
{
    /**
     * Expressions that mean boolean TRUE
     *
     * @var array
     */
    private $trueValues;

    /**
     * Expressions that mean boolean FALSE
     *
     * @var array
     */
    private $falseValues;

    /**
     * @param array $trueValues
     * @param array $falseValues
     */
    public function __construct(
        array $trueValues = array(true, 1, 'true', '1'),
        array $falseValues = array(false, 0, 'false', '0')
    ) {
        $this->trueValues = $trueValues;
        $this->falseValues = $falseValues;
    }

    /**
     * Retrieve boolean value for an expression
     *
     * @param $value
     *
     * @return bool
     * @throws Exception\InvalidArgumentException
     */
    public function toBoolean($value)
    {
        if (in_array($value, $this->trueValues, true)) {
            return true;
        }
        if (in_array($value, $this->falseValues, true)) {
            return false;
        }
        $allowedValues = array_merge($this->trueValues, $this->falseValues);
        throw new Exception\InvalidArgumentException(
            'Boolean value is expected, supported values: ' . var_export_short(
                $allowedValues, true
            )
        );
    }
}