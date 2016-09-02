<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\Controller\Admin;

use WellCart\Admin\Controller\Admin\NotificationsController;
use WellCart\Admin\Spec\NotificationRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NotificationsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $services = $sm->getServiceLocator();
        return new NotificationsController(
            $services->get(
                NotificationRepository::class
            )
        );
    }
}
