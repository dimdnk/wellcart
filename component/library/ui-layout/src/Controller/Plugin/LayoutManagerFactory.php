<?php
namespace WellCart\Ui\Layout\Controller\Plugin;

use WellCart\Ui\Layout\Layout\LayoutInterface;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WellCart\Ui\Layout\Block\BlockPoolInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class LayoutManagerFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return LayoutManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $container = $serviceLocator->getServiceLocator();
        return $this($container, LayoutManager::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return LayoutManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new LayoutManager(
            $container->get(LayoutInterface::class),
            $container->get(LayoutUpdaterInterface::class),
            $container->get(BlockPoolInterface::class)
        );
    }
}
