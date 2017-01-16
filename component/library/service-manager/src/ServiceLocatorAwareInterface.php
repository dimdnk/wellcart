<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ServiceManager;

use Zend\ServiceManager\ServiceLocatorInterface;

interface ServiceLocatorAwareInterface
{

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator);

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator();
}
