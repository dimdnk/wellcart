<?php

namespace WellCart\Ui\Layout\Factory;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\Layout\Layout;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Interop\Container\ContainerInterface;
use Zend\Mvc\View\Http\ViewManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WellCart\Ui\Layout\Options\ModuleOptions;

class LayoutFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Layout
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, Layout::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return Layout
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $layout = new Layout(
            $container->get(LayoutUpdaterInterface::class),
            $container->get(BlockPoolInterface::class)
        );
        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $container->get(ModuleOptions::class);
        foreach ($moduleOptions->getGenerators() as $name => $specs) {
            $generator = $container->get($specs['class']);
            $layout->attachGenerator($name, $generator, $specs['priority']);
        }
        return $layout;
    }
}
