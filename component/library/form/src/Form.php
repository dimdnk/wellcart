<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form;

use WellCart\InputFilter\DomainInputFilterSpecConfigTrait;
use WellCart\ORM\Entity;
use WellCart\Utility\Arr;
use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\PriorityList;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class Form extends \Zend\Form\Form implements EventManagerAwareInterface
{
    use DomainInputFilterSpecConfigTrait,
        AddAttributesToRequiredFieldsTrait,
        EventManagerAwareTrait;

    /**
     * @var PriorityList
     */
    protected $toolbarButtons;

    /**
     * @var bool
     */
    protected $backButton = true;

    /**
     * @var bool
     */
    protected $resetButton = true;

    /**
     * @var string
     */
    protected $layout = 'partial/form/layout/standard';

    /**
     * @inheritDoc
     */
    public function __construct($name = null, $options = [])
    {
        $this->getEventManager()
          ->setIdentifiers([
          __CLASS__,
          get_class($this)
        ]);
        parent::__construct($name, $options);
        $this->toolbarButtons = new PriorityList;
        $this->toolbarButtons->isLIFO(false);
    }

    public function backButton(bool $value = null)
    {
        if ($value !== null) {
            $this->backButton = $value;
        }
        return $this->backButton;
    }

    public function resetButton(bool $value = null)
    {
        if ($value !== null) {
            $this->resetButton = $value;
        }
        return $this->resetButton;
    }

    /**
     * @return PriorityList
     */
    public function getToolbarButtons()
    {
        return $this->toolbarButtons;
    }

    public function addToolbarButton($button, $priority = 0)
    {
        if ($button instanceof ElementInterface) {
            $name = $button->getName();
            $button->setAttribute('value', $button->getLabel());
            $button->setAttribute(
                'data-disable-with', sprintf(
                    '<span class="fa fa-%s"></span> %s',
                    $button->getOption('fontAwesome')['icon'],
                    $button->getLabel()
                )
            );
        } else {
            $name = $button['name'];
            Arr::set($button, 'options.action_bar_button', true);
            Arr::set($button, 'attributes.role', 'button');
            Arr::set(
                $button, 'attributes.value', Arr::get($button, 'options.label')
            );
            Arr::set(
                $button, 'attributes.data-disable-with', sprintf(
                    '<span class="fa fa-%s"></span> %s',
                    Arr::get($button, 'options.fontAwesome.icon', 'check'),
                    Arr::get($button, 'options.label')
                )
            );
        }

        $this->add($button, ['priority' => $priority]);
        $this->toolbarButtons->insert(
            $name, $this->get($name), $priority
        );
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function add($elementOrFieldset, array $flags = array())
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

    public function getToolbarButton($name)
    {
        return $this->toolbarButtons->get($name);
    }

    public function removeToolbarButton($name)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('name')
        );
        $this->toolbarButtons->remove($name);
        $this->remove($name);
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('name')
        );
        return $this;
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
    public function bindValues(array $values = array())
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
            array('parent', __FUNCTION__), $arguments
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
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     *
     * @return Form
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
        return $this;
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