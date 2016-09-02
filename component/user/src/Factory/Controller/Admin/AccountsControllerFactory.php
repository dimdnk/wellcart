<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller\Admin;

use WellCart\User\Controller\Admin\AccountsController;
use WellCart\User\Spec\UserRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccountsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $controller = new AccountsController(
            $services->get(
                UserRepository::class
            )
        );
        return $controller;
    }
}
