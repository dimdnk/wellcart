<?php
/**
 * @package WellCart\Ui\Layout

 */

namespace WellCart\Ui\Layout\View\Helper;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlockFactory implements FactoryInterface
{
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
