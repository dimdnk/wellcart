<?php

namespace WellCart\Form\JsValidation;

use WellCart\Form\JsValidation\Factory\FormElementFactory;
use WellCart\Form\JsValidation\Factory\FormPrepareFactory;
use WellCart\Form\JsValidation\Factory\ModuleOptionsFactory;
use WellCart\Form\JsValidation\Factory\Renderer\JqueryValidate\RendererFactory as jQueryRendererFactory;
use WellCart\Form\JsValidation\Factory\RendererFactory;
use WellCart\Form\JsValidation\Options\ModuleOptions;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements
    ServiceProviderInterface,
    ConfigProviderInterface,
    ViewHelperProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                ModuleOptions::class                   => ModuleOptionsFactory::class,
                'stroker_form.renderer'                => RendererFactory::class,
                'stroker_form.renderer.jqueryvalidate' => jQueryRendererFactory::class,
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'jsValidationFormPrepare' => FormPrepareFactory::class
            )
        );
    }
}
