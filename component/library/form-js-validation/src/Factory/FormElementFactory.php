<?php

namespace WellCart\Form\JsValidation\Factory;

use WellCart\Form\JsValidation\View\Helper\FormElement;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormElementFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return FormElement
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $renderer = $serviceLocator->getServiceLocator()->get('stroker_form.renderer');

        return new FormElement($renderer);
    }
}
