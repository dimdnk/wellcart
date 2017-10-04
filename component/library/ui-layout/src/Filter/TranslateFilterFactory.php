<?php
/**
 * @package WellCart\Ui\Layout

 */

namespace WellCart\Ui\Layout\Filter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TranslateFilterFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return TranslateFilter|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $container = $serviceLocator->getServiceLocator();
        return $this($container, TranslateFilter::class);
    }

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
