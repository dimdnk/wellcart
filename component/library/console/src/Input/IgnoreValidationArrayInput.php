<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Console\Input;

class IgnoreValidationArrayInput
    extends \Symfony\Component\Console\Input\ArrayInput
{
    protected $ignoreValidationErrors = false;

    /**
     * Ignores validation errors.
     *
     * This is mainly useful for the help command.
     */
    public function ignoreValidationErrors()
    {
        $this->ignoreValidationErrors = true;
    }

    /**
     * Validates the input.
     *
     * @throws \RuntimeException When not enough arguments are given
     */
    public function validate()
    {
        if ($this->ignoreValidationErrors === false) {
            parent::validate();
        }
    }


}