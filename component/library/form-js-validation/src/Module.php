<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

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
                'form_js_validation.renderer'                => RendererFactory::class,
                'form_js_validation.renderer.jquery_validate' => jQueryRendererFactory::class,
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
