<?php
namespace WellCart\Ui\Layout\Listener\Factory;

use WellCart\Ui\Layout\Listener\BodyClassListener;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class BodyClassListenerFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return BodyClassListener
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, BodyClassListener::class);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return BodyClassListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $bodyClassHelper = $container->get('ViewHelperManager')->get('bodyClass');
        return new BodyClassListener(
            $bodyClassHelper
        );
    }
}
