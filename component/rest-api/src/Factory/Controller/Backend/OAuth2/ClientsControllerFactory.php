<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Factory\Controller\Backend\OAuth2;

use Interop\Container\ContainerInterface;
use WellCart\RestApi\Controller\Backend\OAuth2\ClientsController;

class ClientsControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): ClientsController
    {
        $controller = new ClientsController(
            $sm->getServiceLocator()
                ->get(\WellCart\RestApi\Repository\OAuth2\Clients::class)
        );
        return $controller;
    }
}
