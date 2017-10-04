<?php
/**
 * @package
 
 */

namespace WellCart\Ui\Layout\Generator;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\Block\Factory\BlockFactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlocksGeneratorFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, BlocksGenerator::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return BlocksGenerator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $blocksGenerator = new BlocksGenerator(
            $container->get(BlockFactoryInterface::class),
            $container->get(BlockPoolInterface::class)
        );
        return $blocksGenerator;
    }
}
