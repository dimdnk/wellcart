<?php

namespace WellCart\Ui\Theme\Adapter;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Theme selector abstract adapter
 */
abstract class AbstractAdapter implements AdapterInterface
{
    protected $serviceLocator;
    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Persist the name of the theme in the adapter if possible
     * @param string $theme
     * @return bool
     */
    public function setTheme($theme)
    {
        return false;
    }

}