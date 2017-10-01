<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace  WellCart\Ui\Theme\Adapter;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Theme selector adapter interface
 */
interface AdapterInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(ServiceLocatorInterface $serviceLocator);

    /**
     * Get the name of the theme from the adapter
     * @abstract
     * @return string | null
     */
    public function getTheme();

    /**
     * Persist the name of the theme in the adapter if possible
     * @abstract
     * @param string $theme
     * @return bool
     */
    public function setTheme($theme);
}