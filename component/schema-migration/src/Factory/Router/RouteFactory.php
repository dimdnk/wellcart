<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\SchemaMigration\Factory\Router;

use Interop\Container\ContainerInterface;
use WellCart\SchemaMigration\Console\PhinxApplication;
use WellCart\SchemaMigration\Router\Route;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RouteFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ): Route {
        $application = $container
            ->get(PhinxApplication::class);

        return new Route(
            $application,
            [
                'controller' => 'SchemaMigration::Console',
                'action'     => 'handle',
            ]
        );
    }
}
