<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller;

use WellCart\Admin\Service\RecoverAccount;
use WellCart\User\Controller\RecoverAccountController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RecoverAccountControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new RecoverAccountController(
            $sm->getServiceLocator()
                ->get(RecoverAccount::class)
        );
        return $controller;
    }
}
