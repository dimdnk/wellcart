<?php
/**
 * @package WellCart\Ui\Layout

 */

namespace WellCart\Ui\Layout\Filter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TranslateFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return TranslateFilter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translator = $container->get('MvcTranslator');
        return new TranslateFilter($translator);
    }
}
