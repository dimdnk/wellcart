<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\JsValidation\Factory\Renderer\JqueryValidate;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Renderer;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Rule\RulePluginManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RendererFactory implements FactoryInterface
{
  /**
   * @inheritDoc
   */
  public function __invoke(ContainerInterface $container, $requestedName,
    array $options = null
  ) {
    $renderer = new Renderer();
    $pluginManager = new RulePluginManager();
    $pluginManager->setServiceLocator($container);
    $renderer->setRulePluginManager($pluginManager);
    return $renderer;
  }
}
