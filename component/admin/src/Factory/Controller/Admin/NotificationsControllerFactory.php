<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Controller\Admin\NotificationsController;
use WellCart\Admin\Spec\NotificationRepository;

class NotificationsControllerFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $services = $sm->getServiceLocator();
        return new NotificationsController(
            $services->get(
                NotificationRepository::class
            )
        );
    }
}
