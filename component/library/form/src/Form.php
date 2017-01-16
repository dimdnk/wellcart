<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Form;

use WellCart\InputFilter\DomainInputFilterSpecConfigTrait;
use WellCart\ORM\Entity;
use WellCart\Utility\Arr;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class Form extends \Zend\Form\Form implements EventManagerAwareInterface
{

    use DomainInputFilterSpecConfigTrait,
        AddAttributesToRequiredFieldsTrait,
        EventManagerAwareTrait;
    /**
     * @inheritDoc
     */
    public function __construct($name = null, $options = [])
    {
        $this->getEventManager()
            ->setIdentifiers(
                [
                    __CLASS__,
                    get_class($this),
                ]
            );
        parent::__construct($name, $options);
    }


    /**
     * @inheritdoc
     */
    public function add($elementOrFieldset, array $flags = [])
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('elementOrFieldset', 'flags')
        );

        $result = parent::add($elementOrFieldset, $flags);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('elementOrFieldset', 'flags', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function remove($elementOrFieldset)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this, compact('elementOrFieldset')
        );
        parent::remove($elementOrFieldset);
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this, compact('elementOrFieldset')
        );

        return $this;
    }

    public function getFromTree(string $element, $delimiter = '.')
    {
        if(strpos($element, $delimiter) === false){
            return $this->get($element);
        }
        if($this->has($element)){
            return $element;
        }
        $keys = explode($delimiter, $element);
        $result = $this;
        do {
            $key = array_shift($keys);
            if($result->has($key))
            {
                $result = $result->get($key);
            } else {
              $result = false;
              break;
            }
        } while ($keys);
        return $result;
    }

    /**
     * Retrieve input filter used by this form
     *
     * @return null|InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->filter) {
            $this->getEventManager()->trigger
            (
                __FUNCTION__,
                $this,
                ['inputFilter' => $this->filter]
            );

            return $this->filter;
        }

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );

        $specs = [];
        if ($this->object instanceof InputFilterProviderInterface) {
            $specs = $this->object->getInputFilterSpecification();
        }
        if ($this->object instanceof Entity) {
            $specs = $this->getDomainEntityInputFilterSpecification(
                $this->object
            );
        }
        if ($this instanceof InputFilterProviderInterface) {
            $specs = Arr::merge($specs, $this->getInputFilterSpecification());
        }

        $this->addAttributesToRequiredFields($specs);

        if (!empty($specs) && null == $this->baseFieldset) {
            $formFactory = $this->getFormFactory();
            $inputFactory = $formFactory->getInputFilterFactory();

            if (!isset($this->filter)) {
                $this->filter = new InputFilter();
            }
            foreach ($specs as $name => $spec) {
                $input = $inputFactory->createInput($spec);
                $this->filter->add($input, $name);
            }
        }

        $inputFilter = parent::getInputFilter();

        $this->getEventManager()->trigger
        (
            __FUNCTION__,
            $this,
            compact('inputFilter')
        );

        return $inputFilter;
    }

    /**
     * Remove all elements or fieldsets
     *
     * @return Form
     */
    public function removeAll()
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );
        foreach ($this->getElements() as $element) {
            $this->remove($element->getName());
        }
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this
        );

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        if ($this->isPrepared) {
            return $this;
        }

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );

        $result = parent::prepare();

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function prepareElement(FormInterface $form)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('form')
        );

        $result = parent::prepareElement($form);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('form')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function setData($data)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('data')
        );

        $result = parent::setData($data);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('data')
        );

        return $result;
    }


    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('object', 'flags')
        );

        $result = parent::bind($object, $flags);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('object', 'flags', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function bindValues(array $values = [])
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('values')
        );

        $result = parent::bindValues($values);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('values', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('hydrator')
        );

        $result = parent::setHydrator($hydrator);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('hydrator', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function setBindOnValidate($bindOnValidateFlag)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('bindOnValidateFlag')
        );

        $result = parent::setBindOnValidate($bindOnValidateFlag);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('bindOnValidateFlag', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function bindOnValidate()
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );

        $result = parent::bindOnValidate();

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this
        );

        return $result;

    }

    /**
     * @inheritdoc
     */
    public function setBaseFieldset(FieldsetInterface $baseFieldset)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('baseFieldset')
        );

        $result = parent::setBaseFieldset($baseFieldset);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('baseFieldset', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getBaseFieldset()
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );

        $result = parent::getBaseFieldset();

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function hasValidated()
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );

        $result = parent::hasValidated();

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this, compact('result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function isValid()
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this
        );

        $result = parent::isValid();

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this, compact('result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this, compact('flag')
        );

        $data = parent::getData($flag);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this, compact('flag', 'data')
        );

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function setValidationGroup()
    {
        $arguments = func_get_args();
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this, compact('arguments')
        );

        $result = call_user_func_array(
            ['parent', __FUNCTION__], $arguments
        );
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this, compact('arguments', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('inputFilter')
        );

        $result = parent::setInputFilter($inputFilter);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('inputFilter', 'result')
        );

        return $result;
    }



    /**
     * Determine is form multipart
     *
     * @return bool
     */
    public function isMultipart(): bool
    {
        return ($this->getAttribute('enctype') == 'multipart/form-data');
    }

    /**
     * @inheritdoc
     */
    protected function prepareBindData(array $values, array $match)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('values', 'match')
        );

        $result = parent::prepareBindData($values, $match);

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('values', 'match', 'result')
        );

        return $result;
    }

    /**
     * @inheritdoc
     */
    protected function prepareValidationGroup(FieldsetInterface $formOrFieldset,
        array $data, array &$validationGroup
    ) {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('formOrFieldset', 'data', 'validationGroup')
        );

        $result = parent::prepareValidationGroup(
            $formOrFieldset, $data, $validationGroup
        );

        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('formOrFieldset', 'data', 'validationGroup', 'result')
        );

        return $result;

    }


}