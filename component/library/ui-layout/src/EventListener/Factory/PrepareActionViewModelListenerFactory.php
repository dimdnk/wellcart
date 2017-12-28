<?php
/**
 * @package WellCart\Ui\Layout
 
 */

namespace WellCart\Ui\Layout\EventListener\Factory;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\EventListener\PrepareActionViewModelListener;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PrepareActionViewModelListenerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return PrepareActionViewModelListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PrepareActionViewModelListener(
            $container->get(BlockPoolInterface::class)
        );
    }
}
