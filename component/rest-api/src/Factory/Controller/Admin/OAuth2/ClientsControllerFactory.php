<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\RestApi\Factory\Controller\Admin\OAuth2;

use WellCart\RestApi\Controller\Admin\OAuth2\ClientsController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new ClientsController(
            $sm->getServiceLocator()
                ->get(\WellCart\RestApi\Repository\OAuth2\Clients::class)
        );
        return $controller;
    }
}
