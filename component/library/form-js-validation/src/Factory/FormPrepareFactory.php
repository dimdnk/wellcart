<?php


namespace WellCart\Form\JsValidation\Factory;

use WellCart\Form\JsValidation\View\Helper\FormPrepare;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Factory for the formPrepare view helper
 */
class FormPrepareFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return FormPrepare
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $renderer = $serviceLocator->getServiceLocator()->get('stroker_form.renderer');

        return new FormPrepare($renderer);
    }
}
