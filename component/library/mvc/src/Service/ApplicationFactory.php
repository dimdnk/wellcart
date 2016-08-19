<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Service;

use Interop\Container\ContainerInterface;
use WellCart\Mvc\Application;

class ApplicationFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Application
     */
    public function __invoke(ContainerInterface $container): Application
    {
        $application = new Application(
            $container->get('Config'), $container
        );
        $application->setEnvironment($_ENV['WELLCART_APPLICATION_ENV']);
        $application->setContext($_ENV['WELLCART_APPLICATION_CONTEXT']);
        return $application;
    }
}
