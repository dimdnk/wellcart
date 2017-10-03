<?php

namespace WellCart\Form\JsValidation\View\Helper;

use WellCart\Form\JsValidation\Renderer\RendererInterface;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\View\Helper\FormElement as BaseHelper;

class FormElement extends BaseHelper
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     *
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $this->renderer->preRenderInputField($element);

        return parent::render($element);
    }
}
