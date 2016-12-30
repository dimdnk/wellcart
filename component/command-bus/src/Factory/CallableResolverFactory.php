<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;

class CallableResolverFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return ServiceLocatorAwareCallableResolver
     */
    public function __invoke(ContainerInterface $container
    ): ServiceLocatorAwareCallableResolver {
        return new ServiceLocatorAwareCallableResolver(
            function ($serviceId) use ($container) {
                $handler = $container->get($serviceId);

                return [$handler, 'handle'];
            }
        );
    }
}
