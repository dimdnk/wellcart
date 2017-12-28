<?php
/**
 * @package WellCart\Ui\Layout
 
 */

namespace WellCart\Ui\Layout\Filter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BasePathFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return BasePathFilter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $basePathHelper = $container
            ->get('viewHelperManager')
            ->get('basePath');
        return new BasePathFilter($basePathHelper);
    }
}
