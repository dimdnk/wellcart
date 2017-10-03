<?php

namespace WellCart\Form\JsValidation\Renderer\JqueryValidate\Rule;

use Zend\Form\ElementInterface;
use Zend\Validator\ValidatorInterface;
use Zend\Validator\Digits as DigitsValidator;

class Digits extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function getRules(ValidatorInterface $validator, ElementInterface $element = null)
    {
        return ['digits' => true];
    }

    /**
     * {@inheritDoc}
     */
    public function getMessages(ValidatorInterface $validator)
    {
        return ['digits' => $this->translateMessage('The input must contain only digits')];
    }

    /**
     * Whether this rule supports certain validators
     *
     * @param ValidatorInterface $validator
     * @return mixed
     */
    public function canHandle(ValidatorInterface $validator)
    {
        return $validator instanceof DigitsValidator;
    }
}
