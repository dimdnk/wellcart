<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\ControllerPlugin;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Mvc\Controller\Plugin\Notification as NotificationPlugin;

class NotificationPluginFactory
{
    public function __invoke(ContainerInterface $sm
    ): NotificationPlugin {
        return new NotificationPlugin(
            $sm->getServiceLocator()
                ->get('admin\notification')
        );
    }
}
