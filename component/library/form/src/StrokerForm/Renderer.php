<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\StrokerForm;

use WellCart\Form\JsValidation\FormManager;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Options;
use WellCart\Form\JsValidation\Renderer\JqueryValidate\Rule\RulePluginManager;
use WellCart\Form\JsValidation\Renderer\RendererInterface;
use Zend\Form\Element\Email;
use Zend\Form\ElementInterface;
use Zend\Form\FormInterface;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\TranslatorAwareTrait;
use Zend\Json\Json;
use Zend\Mvc\Router\RouteInterface;
use Zend\Stdlib\AbstractOptions;
use Zend\Validator\EmailAddress;
use Zend\Validator\Regex;
use Zend\Validator\ValidatorInterface;
use Zend\View\Renderer\PhpRenderer as View;

class Renderer
    implements RendererInterface, TranslatorAwareInterface
{

    use TranslatorAwareTrait;

    /**
     * @var \Zend\Mvc\Router\RouteInterface
     */
    protected $httpRouter;

    /**
     * @var AbstractOptions
     */
    protected $defaultOptions = [];

    /**
     * @var AbstractOptions
     */
    protected $options = [];

    /**
     * @var FormManager
     */
    protected $formManager;

    /**
     * @var array
     */
    protected $skipValidators
        = [
            'Explode',
            'Upload',
        ];

    /**
     * @var RulePluginManager
     */
    protected $rulePluginManager;

    /**
     * @var array
     */
    private $rules = [];

    /**
     * @var array
     */
    private $messages = [];

    /**
     * @return RouteInterface
     */
    public function getHttpRouter()
    {
        return $this->httpRouter;
    }

    /**
     * @param RouteInterface $assetRoute
     */
    public function setHttpRouter(RouteInterface $httpRouter)
    {
        $this->httpRouter = $httpRouter;
    }

    /**
     * @param AbstractOptions $options
     */
    public function setDefaultOptions(AbstractOptions $options = null)
    {
        $this->defaultOptions = $options;
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
    }

    /**
     * Executed before the ZF2 view helper renders the element
     *
     * @param string                          $formAlias
     * @param \Zend\View\Renderer\PhpRenderer $view
     * @param \Zend\Form\FormInterface        $form
     * @param array                           $options
     */
    public function preRenderForm($formAlias, View $view,
        FormInterface $form = null, array $options = []
    ) {
        if ($form === null) {
            $form = $this->getFormManager()->get($formAlias);
        }

        $inputFilter = $form->getInputFilter();

        /** @var $element \Zend\Form\Element */
        $validators = $this->extractValidatorsForForm($form, $inputFilter);
        foreach ($validators as $validator) {
            $element = $validator['element'];
            foreach ($validator['validators'] as $val) {
                $this->addValidationAttributesForElement(
                    $formAlias, $element, $val['instance']
                );
            };
        }

        /** @var $options Options */
        $options = $this->getOptions();

        $inlineScript = $view->plugin('inlineScript');

        $script = $this->getInlineJavascript($form, $options);
        $inlineScript->appendScript($script);
    }

    /**
     * @return FormManager
     */
    public function getFormManager()
    {
        return $this->formManager;
    }

    /**
     * @param FormManager $formManager
     */
    public function setFormManager(FormManager $formManager)
    {
        $this->formManager = $formManager;
    }

    public function extractValidatorsForForm($formOrFieldset, $inputFilter)
    {
        $foundValidators = [];
        foreach ($formOrFieldset->getElements() as $element) {
            $validators = $this->getValidatorsForElement(
                $inputFilter, $element
            );
            if (count($validators) > 0) {
                $foundValidators[] = [
                    'element'    => $element,
                    'validators' => $validators,
                ];
            }
        }


        /** @var $fieldset \Zend\Form\FieldSetInterface */
        foreach ($formOrFieldset->getFieldsets() as $key => $fieldset) {
            if (is_integer($key)) {
                continue;
            }
            $foundValidators = array_merge(
                $foundValidators, $this->extractValidatorsForForm(
                $fieldset, $inputFilter->get($key)
            )
            );
        }

        return $foundValidators;
    }

    public function getValidatorsForElement($inputFilter, $element)
    {
        if ($element->getOption('strokerform-exclude')) {
            return;
        }

        // Check if we are dealing with a fieldset element
        if (preg_match('/^.*\[(.*)\]$/', $element->getName(), $matches)) {
            $elementName = $matches[1];
        } else {
            $elementName = $element->getName();
        }

        if (!$inputFilter->has($elementName)) {
            return;
        }
        $input = $inputFilter->get($elementName);

        // Make sure NotEmpty validator is added when input is required
        $input->isValid();

        $chain = $input->getValidatorChain();

        return $chain->getValidators();
    }

    /**
     * @param string                             $formAlias
     * @param \Zend\Form\ElementInterface        $element
     * @param \Zend\Validator\ValidatorInterface $validator
     *
     * @return mixed|void
     */
    protected function addValidationAttributesForElement($formAlias,
        ElementInterface $element, ValidatorInterface $validator = null
    ) {
        if (in_array(
            $this->getValidatorClassName($validator), $this->skipValidators
        )) {
            return;
        }
        if ($element instanceof Email && $validator instanceof Regex) {
            $validator = new EmailAddress();
        }

        $rule = $this->getRule($validator);
        if ($rule !== null) {
            $rules = $rule->getRules($validator, $element);
            $messages = $rule->getMessages($validator);
        } else {
            $rules = [];
            $messages = [];
        }

        $elementName = $this->getElementName($element);

        if (!isset($this->rules[$elementName])) {
            $this->rules[$elementName] = [];
        }
        $this->rules[$elementName] = array_merge(
            $this->rules[$elementName], $rules
        );
        if (!isset($this->messages[$elementName])) {
            $this->messages[$elementName] = [];
        }
        $this->messages[$elementName] = array_merge(
            $this->messages[$elementName], $messages
        );
    }

    /**
     * Get the classname of the zend validator
     *
     * @param  \Zend\Validator\ValidatorInterface $validator
     *
     * @return mixed
     */
    protected function getValidatorClassName(ValidatorInterface $validator = null
    ) {
        $namespaces = explode('\\', get_class($validator));

        return end($namespaces);
    }

    /**
     * @param  \Zend\Validator\ValidatorInterface $validator
     *
     * @return null|Rule\AbstractRule
     */
    public function getRule(ValidatorInterface $validator = null)
    {
        $validatorName = lcfirst($this->getValidatorClassName($validator));
        if ($this->getRulePluginManager()->has($validatorName)) {
            $rule = $this->getRulePluginManager()->get($validatorName);
            if ($rule instanceof TranslatorAwareInterface) {
                $rule->setTranslatorTextDomain(
                    $this->getTranslatorTextDomain()
                );
            }

            return $rule;
        }

        return null;
    }

    /**
     * @return RulePluginManager
     */
    public function getRulePluginManager()
    {
        return $this->rulePluginManager;
    }

    /**
     * @param RulePluginManager $rulePluginManager
     */
    public function setRulePluginManager(RulePluginManager $rulePluginManager)
    {
        $this->rulePluginManager = $rulePluginManager;
    }

    /**
     * Get the name of the form element
     *
     * @param  \Zend\Form\ElementInterface $element
     *
     * @return string
     */
    protected function getElementName(ElementInterface $element)
    {
        $elementName = $element->getName();
        if ($element instanceof \Zend\Form\Element\MultiCheckbox
            && !$element instanceof \Zend\Form\Element\Radio
        ) {
            $elementName .= '[]';
        }

        return $elementName;
    }

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
        $this->options = clone $this->defaultOptions;
        $this->options->setFromArray($options);
    }

    /**
     * @param  \Zend\Form\FormInterface $form
     * @param Options                   $options
     *
     * @return string
     */
    protected function getInlineJavascript(FormInterface $form, Options $options
    ) {

        $validateOptions = [];
        foreach ($options->getValidateOptions() as $key => $value) {
            $value = (is_string($value))
                ? $value
                : var_export_short(
                    $value, true
                );
            $validateOptions[] = '"' . $key . '": ' . $value;
        }

        return sprintf(
            $options->getInitializeTrigger(),
            sprintf(
                '$(\'form[name="%s"]\').validate({%s"rules":%s,"messages":%s});',
                $form->getName(),
                count($validateOptions) > 0 ?
                    implode(',', $validateOptions) . ',' : '',
                Json::encode($this->rules),
                Json::encode($this->messages)
            )
        );
    }
}