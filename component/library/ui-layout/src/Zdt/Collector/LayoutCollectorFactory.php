<?php
/**
 * @package WellCart\Ui\Layout
 
 */

namespace WellCart\Ui\Layout\Zdt\Collector;

use WellCart\Ui\Layout\Layout\LayoutInterface;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LayoutCollectorFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LayoutCollector::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return LayoutCollector
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $layoutCollector = new LayoutCollector(
            $container->get(LayoutInterface::class),
            $container->get(LayoutUpdaterInterface::class),
            $container->get('ViewResolver')
        );
        return $layoutCollector;
    }
}
