<?php

namespace WellCart\Ui\Layout\Updater;

use WellCart\Ui\Layout\Options\ModuleOptions;
use WellCart\Ui\Layout\Updater\Collector\FilesystemCollector;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class LayoutUpdaterFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LayoutUpdater::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return LayoutUpdater
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $updater = new LayoutUpdater();
        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $container->get(ModuleOptions::class);
        foreach ($moduleOptions->getCollectors() as $name => $collector) {
            $updater->attachCollector(
                $name,
                $container->get($collector['class']),
                $collector['priority']
            );
        }
        return $updater;
    }
}
