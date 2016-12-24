<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Controller\SettingsController;

class SettingsControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): SettingsController
    {
        return new SettingsController(
            $sm->getServiceLocator()
                ->get('system_configuration_editor')
        );
    }
}
