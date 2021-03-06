<?php

namespace WellCart\Ui\Layout\View\Helper\Proxy;

use WellCart\Ui\Layout\Options\ModuleOptions;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class ViewHelperProxyAbstractFactory implements AbstractFactoryInterface
{
    /**
     *
     * @var string
     */
    protected $helperAlias;

    /**
     *
     * @var string
     */
    protected $proxyClass;

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $container = $serviceLocator->getServiceLocator();
        return $this->canCreate($container, $requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        /* @var $moduleOptions ModuleOptions */
        $moduleOptions = $container->get(ModuleOptions::class);

        foreach ($moduleOptions->getViewHelpers() as $helperAlias => $helperConfig) {
            if (isset($helperConfig['proxy']) &&
                $helperConfig['proxy'] === $requestedName
            ) {
                $this->helperAlias = $helperAlias;
                $this->proxyClass  = $requestedName;
                return true;
            }
        }
        return false;
    }

    /**
     * @param ServiceLocatorInterface $viewHelperManager
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $viewHelperManager, $name, $requestedName)
    {
        $container = $viewHelperManager->getServiceLocator();
        return $this($container, $requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $viewHelperManager = $container->get('ViewHelperManager');
        $helper = $viewHelperManager->get($this->helperAlias);
        $proxy  =  new $this->proxyClass($helper);
        return $proxy;
    }
}
