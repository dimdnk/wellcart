<?php
/**
 * @package WellCart\Ui\Layout

 */

namespace WellCart\Ui\Layout\View\Helper;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlockFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Block
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $container = $serviceLocator->getServiceLocator();
        return $this($container, Block::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return Block
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Block(
            $container->get(BlockPoolInterface::class)
        );
    }
}
