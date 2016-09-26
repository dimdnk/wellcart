<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Service\RecoverAccount;
use WellCart\User\Controller\RecoverAccountController;

class RecoverAccountControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): RecoverAccountController
    {
        $controller = new RecoverAccountController(
            $sm->getServiceLocator()
                ->get(RecoverAccount::class)
        );
        return $controller;
    }
}
