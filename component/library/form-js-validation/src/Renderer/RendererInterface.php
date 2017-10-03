<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

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
     * @param View                     $view
     * @param \Zend\Form\FormInterface $form
     * @param array                    $options
     *
     * @return
     */
    public function preRenderForm( View $view, FormInterface $form, array $options = []);

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
