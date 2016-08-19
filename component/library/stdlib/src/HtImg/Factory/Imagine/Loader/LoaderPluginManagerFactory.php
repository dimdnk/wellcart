<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Stdlib\HtImg\Factory\Imagine\Loader;

use HtImgModule\Imagine\Loader\LoaderPluginManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;

class LoaderPluginManagerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LoaderPluginManager
     */
    public function __invoke(ContainerInterface $container): LoaderPluginManager
    {
        $service = new LoaderPluginManager(
            new Config($container->get('Config')['htimg']['loaders'])
        );
        $service->setServiceLocator($container);
        return $service;
    }
}
