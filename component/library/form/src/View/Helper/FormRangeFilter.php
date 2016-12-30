<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\View\Helper;

use WellCart\Form\Element\RangeFilter as RangeFilterElement;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\View\Helper\FormNumber;

class FormRangeFilter extends AbstractHelper
{
    /**
     * FormNumber helper
     *
     * @var FormNumber
     */
    protected $numberHelper;

    /**
     * Invoke helper as function
     *
     * Proxies to {@link render()}.
     *
     * @param ElementInterface|null $element
     *
     * @return $this|string
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * Render a month element that is composed of two selects
     *
     * @param  \Zend\Form\ElementInterface $element
     *
     * @throws \Zend\Form\Exception\InvalidArgumentException
     * @throws \Zend\Form\Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        if (!$element instanceof RangeFilterElement) {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    '%s requires that the element is of type WellCart\Form\Element\RangeFilter',
                    __METHOD__
                )
            );
        }
        /**
         * @var $element \WellCart\Form\Element\RangeFilter
         */

        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(
                sprintf(
                    '%s requires that the element has an assigned name; none discovered',
                    __METHOD__
                )
            );
        }

        $numberHelper = $this->getNumberElementHelper();
        $markup
            = '
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>' . __('From:') . '</td>
                        <td> %s</td>
                    </tr>
                    <tr>
                        <td>' . __('To:') . '</td>
                        <td> %s</td>
                    </tr>
                </tbody>
            </table>
            ';


        $start = $numberHelper->render($element->getStartElement());
        $end = $numberHelper->render($element->getEndElement());

        return sprintf($markup, $start, $end);
    }


    /**
     * Retrieve the FormNumber helper
     *
     * @return FormNumber
     */
    protected function getNumberElementHelper()
    {
        if ($this->numberHelper) {
            return $this->numberHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->numberHelper = $this->view->plugin('formtext');
        }

        return $this->numberHelper;
    }

}