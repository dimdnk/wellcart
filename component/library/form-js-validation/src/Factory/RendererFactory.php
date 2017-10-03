<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\JsValidation\Factory;

use Interop\Container\ContainerInterface;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Options;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Rule\RulePluginManager;
use WellCart\Form\JsValidation\Renderer\Renderer;

class RendererFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return Renderer
     */
    public function __invoke(ContainerInterface $container): Renderer
    {
        $renderer = new  Renderer();
        $pluginManager = new RulePluginManager();
        $pluginManager->setServiceLocator($container);
        $renderer->setRulePluginManager($pluginManager);

        $config = [];
        $options = new Options($config);
        $renderer->setDefaultOptions($options);
        $renderer->setOptions($config);

        return $renderer;
    }
}