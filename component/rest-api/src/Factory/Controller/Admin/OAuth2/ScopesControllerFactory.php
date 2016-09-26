<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\RestApi\Factory\Controller\Admin\OAuth2;

use Interop\Container\ContainerInterface;
use WellCart\RestApi\Controller\Admin\OAuth2\ScopesController;

class ScopesControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): ScopesController
    {
        $controller = new ScopesController(
            $sm->getServiceLocator()
                ->get(\WellCart\RestApi\Repository\OAuth2\Scopes::class)
        );
        return $controller;
    }
}
