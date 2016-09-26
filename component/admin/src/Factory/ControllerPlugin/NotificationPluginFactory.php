<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\ControllerPlugin;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Mvc\Controller\Plugin\Notification as NotificationPlugin;

class NotificationPluginFactory
{
    public function __invoke(ContainerInterface $sm
    ): NotificationPlugin
    {
        return new NotificationPlugin(
            $sm->getServiceLocator()
                ->get('admin\notification')
        );
    }
}
