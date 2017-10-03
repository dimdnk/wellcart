<?php

namespace WellCart\Form\JsValidation\Factory;

use WellCart\Form\JsValidation\FormManager;
use WellCart\Form\JsValidation\Options\ModuleOptions;
use WellCart\Form\JsValidation\Renderer\RendererCollection;
use WellCart\Form\JsValidation\Renderer\RendererInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RendererFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return RendererInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $options ModuleOptions */
        $options = $serviceLocator->get(ModuleOptions::class);
        $rendererCollection = new RendererCollection();
        foreach ($options->getActiveRenderers() as $rendererAlias) {
            /** @var $renderer RendererInterface */
            $renderer = $serviceLocator->get($rendererAlias);
            $renderer->setDefaultOptions($options->getRendererOptions($rendererAlias));
            $renderer->setFormManager($serviceLocator->get(FormManager::class));
            if ($serviceLocator->has('translator')) {
                $renderer->setTranslator($serviceLocator->get('translator'));
            }
            $renderer->setHttpRouter($serviceLocator->get('HttpRouter'));
            $rendererCollection->addRenderer($renderer);
        }

        return $rendererCollection;
    }
}
