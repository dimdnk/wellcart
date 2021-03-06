<?php
/**
 * @package WellCart\Ui\Layout
 
 */

namespace WellCart\Ui\Layout\Filter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DebugFilterFactory implements FactoryInterface
{
  /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return DebugFilter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $viewHelperManager = $container->get('ViewHelperManager');
        return new DebugFilter(
            $viewHelperManager->get('viewModel')
        );
    }
}
