<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller;

use WellCart\User\Controller\ConfirmEmailController;
use WellCart\User\Service\Registration\AccountEmailHandler;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfirmEmailControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new ConfirmEmailController(
            $sm->getServiceLocator()
                ->get(
                    AccountEmailHandler::class
                )
        );
        return $controller;
    }
}
