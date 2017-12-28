<?php

namespace WellCart\Ui\Layout\Options;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return ModuleOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $options = isset($config['wellcart']['layout']) ? $config['wellcart']['layout'] : [];
        $moduleOptions = new ModuleOptions(
            $options
        );
        return $moduleOptions;
    }
}
