<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Controller\Backend\NotificationsController;
use WellCart\Backend\Spec\NotificationRepository;

class NotificationsControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): NotificationsController
    {
        $services = $sm->getServiceLocator();
        return new NotificationsController(
            $services->get(
                NotificationRepository::class
            )
        );
    }
}
