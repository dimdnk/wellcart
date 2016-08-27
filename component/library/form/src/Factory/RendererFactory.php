<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Factory\StrokerForm;

use Interop\Container\ContainerInterface;
use StrokerForm\Renderer\JqueryValidate\Options;
use StrokerForm\Renderer\JqueryValidate\Rule\RulePluginManager;
use WellCart\Form\StrokerForm\Renderer;

class RendererFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Renderer
     */
    public function __invoke(ContainerInterface $container) : Renderer
    {
        $renderer = new  Renderer();
        $pluginManager = new RulePluginManager();
        $pluginManager->setServiceLocator($container);
        $renderer->setRulePluginManager($pluginManager);

        $config = ['include_assets' => false];
        $options = new Options($config);
        $renderer->setDefaultOptions($options);
        $renderer->setOptions($config);
        return $renderer;
    }
}