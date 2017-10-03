<?php

namespace WellCart\Form\JsValidation\Renderer;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\TranslatorAwareTrait;
use Zend\Stdlib\AbstractOptions;

abstract class AbstractRenderer implements RendererInterface, TranslatorAwareInterface
{
    use TranslatorAwareTrait;

    /**
     * @var AbstractOptions
     */
    protected $defaultOptions = [];

    /**
     * @var Options
     */
    protected $options = null;

    /**
     * @return AbstractOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options = [])
    {
        if ($this->options === null) {
            $this->options = clone $this->defaultOptions;
        }

        foreach ($options as $key => $value) {
            if (isset($this->options->{$key}) && is_array($this->options->{$key})) {
                $options[$key] = $this->options->mergeRecursive($this->options->{$key}, $value);
            }
        }

        $this->options->setFromArray($options);
    }

    /**
     * @param AbstractOptions $options
     */
    public function setDefaultOptions(AbstractOptions $options = null)
    {
        $this->defaultOptions = $options;
    }
}
