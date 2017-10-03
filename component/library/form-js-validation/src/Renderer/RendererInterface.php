<?php

namespace WellCart\Form\JsValidation\Renderer;

use Zend\Form\ElementInterface;
use Zend\Form\FormInterface;
use Zend\Stdlib\AbstractOptions;
use Zend\View\Renderer\PhpRenderer as View;

interface RendererInterface
{
    /**
     * Excecuted before the ZF2 view helper renders the element
     *
     * @param string                   $formAlias
     * @param View                     $view
     * @param \Zend\Form\FormInterface $form
     * @param array                    $options
     *
     * @return
     */
    public function preRenderForm($formAlias, View $view, FormInterface $form = null, array $options = []);

    /**
     * Excecuted before the ZF2 view helper renders the element
     *
     * @param ElementInterface $element
     */
    public function preRenderInputField(ElementInterface $element);

    /**
     * Set renderer options
     *
     * @param AbstractOptions $options
     */
    public function setDefaultOptions(AbstractOptions $options = null);
}
