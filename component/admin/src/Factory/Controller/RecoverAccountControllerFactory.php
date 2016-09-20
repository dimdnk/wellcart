<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Controller\RecoverAccountController;
use WellCart\Admin\Service\RecoverAccount;

class RecoverAccountControllerFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null): RecoverAccountController
    {
        return new RecoverAccountController(
            $sm->getServiceLocator()
                ->get(RecoverAccount::class)
        );
    }
}
