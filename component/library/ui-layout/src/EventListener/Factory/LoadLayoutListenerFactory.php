<?php

namespace WellCart\Ui\Layout\EventListener\Factory;

use WellCart\Ui\Layout\Layout\LayoutInterface;
use WellCart\Ui\Layout\EventListener\LoadLayoutListener;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class LoadLayoutListenerFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return LoadLayoutListener
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LoadLayoutListener::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return LoadLayoutListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $injectBlocksListener = new LoadLayoutListener(
            $container->get(LayoutInterface::class)
        );
        return $injectBlocksListener;
    }
}
