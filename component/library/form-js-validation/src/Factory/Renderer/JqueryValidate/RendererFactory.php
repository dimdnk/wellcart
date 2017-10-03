<?php

namespace WellCart\Form\JsValidation\Factory\Renderer\JqueryValidate;

use WellCart\Form\JsValidation\Renderer\JqueryValidate\Renderer;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Rule\RulePluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RendererFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $renderer = new Renderer();
        $pluginManager = new RulePluginManager();
        $pluginManager->setServiceLocator($serviceLocator);
        $renderer->setRulePluginManager($pluginManager);
        return $renderer;
    }
}
