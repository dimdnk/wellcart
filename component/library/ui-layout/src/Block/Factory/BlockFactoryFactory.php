<?php

namespace WellCart\Ui\Layout\Block\Factory;

use WellCart\Ui\Layout\BlockManager;
use WellCart\Ui\Layout\Options\ModuleOptions;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class BlockFactoryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, BlockFactory::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return BlockFactory
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var $options ModuleOptions */
        $options = $container->get(ModuleOptions::class);
        $blockFactory = new BlockFactory(
            $options->getBlockDefaults(),
            $container->get(BlockManager::class),
            $container
        );
        return $blockFactory;
    }
}
