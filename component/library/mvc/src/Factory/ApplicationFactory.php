<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Factory;

use Interop\Container\ContainerInterface;
use WellCart\Mvc\Application;
use Zend\Mvc\ApplicationInterface;

class ApplicationFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return ApplicationInterface
     */
    public function __invoke(ContainerInterface $container
    ): ApplicationInterface {
        return new Application(
            $container->get('Config'), $container,
            null, null, null,
            $_ENV['WELLCART_APPLICATION_CONTEXT'],
            $_ENV['WELLCART_APPLICATION_ENV'],
            new Application\MaintenanceMode
        );
    }
}
