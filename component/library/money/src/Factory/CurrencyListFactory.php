<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use WellCart\Money\Service\CurrencyList;

class CurrencyListFactory implements FactoryInterface
{
  /**
   * @inheritDoc
   */
  public function __invoke(ContainerInterface $container, $requestedName,
    array $options = null
  ) {
    $config = $container->get('config');
    $config = isset($config['wellcart']['money']) ? $config['wellcart']['money'] : array();
    $list = new CurrencyList;

    if (isset($config['allow_currencies']) && is_array($config['allow_currencies'])) {
      $list->setAllow($config['allow_currencies']);
    }
    if (isset($config['exclude_currencies'])  && is_array($config['exclude_currencies'])) {
      $list->remove($config['exclude_currencies']);
    }

    return $list;
  }
}
