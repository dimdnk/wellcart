<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Rbac\Guard;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use WellCart\Backend\Rbac\Guard\RouteGuard;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RouteGuardFactory
    implements FactoryInterface, MutableCreationOptionsInterface
{

    /**
     * @var array
     */
    protected $options = [];

    /**
     * {@inheritDoc}
     */
    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }

  /**
   * @inheritDoc
   */
  public function __invoke(ContainerInterface $container, $requestedName,
    array $options = null
  ) {
    $parentLocator = $container->getServiceLocator();

    /* @var \ZfcRbac\Options\ModuleOptions $moduleOptions */
    $moduleOptions = $parentLocator->get('ZfcRbac\Options\ModuleOptions');

    /* @var \ZfcRbac\Service\RoleService $roleService */
    $roleService = $parentLocator->get('ZfcRbac\Service\RoleService');

    $routeGuard = new RouteGuard($roleService, $this->options);
    $routeGuard->setProtectionPolicy($moduleOptions->getProtectionPolicy());

    return $routeGuard;
  }
}
