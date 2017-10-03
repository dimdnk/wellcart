<?php

namespace WellCart\Form\JsValidation\Renderer;

use Zend\Form\ElementInterface;
use Zend\Form\FormInterface;
use Zend\View\Renderer\PhpRenderer as View;

class RendererCollection extends AbstractRenderer
{
    /**
     * @var RendererInterface[]
     */
    private $renderers = [];

    /**
     * Get inner renderers
     *
     * @return RendererInterface[]
     */
    public function getRenderers()
    {
        return $this->renderers;
    }

    /**
     * Add a renderer
     *
     * @param RendererInterface $renderer
     */
    public function addRenderer(RendererInterface $renderer)
    {
        $this->renderers[] = $renderer;
    }

    /**
     * Excecuted before the ZF2 view helper renders the element
     *
     * @param  \Zend\View\Renderer\PhpRenderer $view
     * @param  \Zend\Form\FormInterface        $form
     * @param array                            $options
     *
     * @return mixed
     */
    public function preRenderForm(View $view, FormInterface $form, array $options = [])
    {
        foreach ($this->getRenderers() as $renderer) {
            $renderer->preRenderForm($view, $form, $options);
        }
    }

    /**
     * Excecuted before the ZF2 view helper renders the element
     *
     * @param  ElementInterface $element
     *
     * @return mixed
     */
    public function preRenderInputField(ElementInterface $element)
    {
        foreach ($this->getRenderers() as $renderer) {
            $renderer->preRenderInputField($element);
        }
    }
}
