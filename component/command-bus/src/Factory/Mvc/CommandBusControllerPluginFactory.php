<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Factory\Mvc;

use Interop\Container\ContainerInterface;
use WellCart\CommandBus\Mvc\Controller\Plugin\CommandBus;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommandBusControllerPluginFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommandBus
     */
    public function __invoke(ContainerInterface $container): CommandBus
    {
        return new CommandBus($container->get('command_bus'));
    }

    /**
     * @param ServiceLocatorInterface $container
     *
     * @return CommandBus
     */
    public function createService(ServiceLocatorInterface $container)
    {
        $parentContainer = $container->getServiceLocator() ?: $container;
        return $this($parentContainer, CommandBus::class);
    }
}
