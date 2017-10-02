<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Step;

use Zend\ServiceManager\AbstractPluginManager;
use WellCart\Ui\Wizard\Exception;

class StepPluginManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof StepInterface) {
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement WellCart\Ui\Wizard\StepInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}