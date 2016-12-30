<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Element;

use Zend\Form\Element;
use Zend\Form\ElementPrepareAwareInterface;
use Zend\Form\FormInterface;
use Zend\InputFilter\InputProviderInterface;

class RangeFilter extends Element
    implements InputProviderInterface, ElementPrepareAwareInterface
{
    /**
     * Input form element that contains values for start
     *
     * @var Element\Text
     */
    protected $startElement;

    /**
     * Input form element that contains values for end
     *
     * @var Element\Text
     */
    protected $endElement;

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes
        = [
            'type' => 'rangefilter',
        ];

    /**
     * Constructor. Add two elements
     *
     * @param  null|int|string $name    Optional name for the element
     * @param  array           $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        $this->startElement = new Element\Text('start');
        $this->endElement = new Element\Text('end');

        parent::__construct($name, $options);
    }

    /**
     * @return Element\Number
     */
    public function getStartElement()
    {
        return $this->startElement;
    }

    /**
     * @return Element\Number
     */
    public function getEndElement()
    {
        return $this->endElement;
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInput()}.
     *
     * @return array
     */
    public function getInputSpecification()
    {
        return array(
            'name'       => $this->getName(),
            'required'   => false,
            'filters'    => array(
                array(
                    'name'    => 'Callback',
                    'options' => array(
                        'callback' => function ($date) {
                            // Convert the date to a specific format
                            if (is_array($date)) {
                                $date = $date['start'] . ' - ' . $date['end'];
                            }

                            return $date;
                        }
                    )
                )
            ),
            'validators' => array()
        );
    }

    /**
     * Prepare the form element (mostly used for rendering purposes)
     *
     * @param  FormInterface $form
     *
     * @return mixed
     */
    public function prepareElement(FormInterface $form)
    {
        $name = $this->getName();
        $this->startElement->setName($name . '[start]');
        $this->endElement->setName($name . '[end]');
    }

    /**
     * @param array|\Traversable $options
     *
     * @return RangeFilter
     */
    public function setOptions($options)
    {
        parent::setOptions($options);
        if (isset($options['start_attributes'])) {
            $this->startElement->setAttributes($options['start_attributes']);
        }
        if (isset($options['end_attributes'])) {
            $this->endElement->setAttributes($options['end_attributes']);
        }
        return $this;
    }

    /**
     * Set the element value
     *
     * @param  mixed $value
     *
     * @return Element
     */
    public function setValue($value)
    {
        $this->value = $value;

        if (is_array($value)
            && isset($value['start'])
            && isset($value['end'])
        ) {
            $value = array_map('doubleval', $value);
            if ($value['start'] && $value['end']) {

                $start = $value['start'];
                $end = $value['end'];

                if ($start <= $end) {
                    $this->startElement->setValue($start);
                    $this->endElement->setValue($end);
                }
            }
        }

        return $this;
    }


    /**
     * @return string
     */
    public function getValue()
    {
        return sprintf(
            '%s - %s',
            $this->startElement->getValue(),
            $this->endElement->getValue()
        );
    }
}