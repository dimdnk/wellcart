<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Factory\Mvc;

use Interop\Container\ContainerInterface;
use WellCart\CommandBus\Mvc\Controller\Plugin\CommandBus;

class CommandBusControllerPluginFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return CommandBus
     */
    public function __invoke(ContainerInterface $container): CommandBus
    {
        return new CommandBus(
            $container
                ->getServiceLocator()
                ->get('command_bus')
        );
    }
}
