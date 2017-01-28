<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Layout\EventListener;

class ActionHandlesListener extends
    \ConLayout\Listener\ActionHandlesListener
{

    /**
     * Determine the module name of the controller
     *
     * @param  string $controller
     *
     * @return string
     */
    protected function deriveModuleNamespace($controller)
    {
        if (!strstr($controller, '\\')) {
            return '';
        }

        // Retrieve second element representing module name.
        $nsArray = explode('\\', $controller);
        $subNsArray = array_slice($nsArray, 1, 1);

        return implode('/', $subNsArray);
    }
}