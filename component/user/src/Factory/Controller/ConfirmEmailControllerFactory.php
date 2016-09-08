<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\ConfirmEmailController;
use WellCart\User\Service\Registration\AccountEmailHandler;

class ConfirmEmailControllerFactory
{
    public function __invoke(ContainerInterface $sm): ConfirmEmailController
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
