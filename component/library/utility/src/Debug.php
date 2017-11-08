<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


namespace WellCart\Utility;

/**
 * Concrete class for generating debug dumps related to the output source.
 */
abstract class Debug
{

    /**
     * Debug helper function.
     *
     * @param mixed $var The variable to dump.
     *
     * @return string
     */
    public static function dump($var)
    {
        dump($var);
    }
}