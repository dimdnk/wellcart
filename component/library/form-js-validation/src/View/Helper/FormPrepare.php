<?php

namespace WellCart\Form\JsValidation\View\Helper;

use WellCart\Form\JsValidation\Renderer\RendererInterface;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper\AbstractHelper;

class FormPrepare extends AbstractHelper
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
     * @param \Zend\Form\FormInterface $form
     * @param array                    $options
     */
    public function __invoke(FormInterface $form, array $options = [])
    {
        $this->renderer->preRenderForm($this->getView(), $form, $options);
    }
}
