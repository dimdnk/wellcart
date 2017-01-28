<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Datagrid\View\Helper;

use WellCart\Form\Form;
use WellCart\Ui\Datagrid\Controller\Plugin\GridFilterBuilder;
use Zend\View\Helper\AbstractHelper;

class GridFilters extends AbstractHelper
{

    /**
     * @var \WellCart\Ui\Datagrid\Controller\Plugin\GridFilterBuilder
     */
    protected $builder;

    /**
     * @var Form
     */
    protected $form;


    protected $sorterLinks;

    public function __construct(
        GridFilterBuilder $builder, Form $form
    ) {
        $this->builder = $builder;
        $this->form = $form;

        $this->form->setAttribute('method', 'GET');
        $this->form->setWrapElements(true);
    }

    /**
     * @param string $scopeName
     *
     * @return GridFilters
     */
    public function __invoke($scopeName)
    {
        $this->builder->setScope($scopeName);
        $scopeInfo = $this->builder->getScopeInfo();

        $columns = array_keys($scopeInfo['form_elements']);
        $formElements = (array)$scopeInfo['form_elements'];
        $values = (array)$scopeInfo['values'];

        $controller = $this->builder->getController();
        $sorter = new GridFilter\Sorter(
            $values,
            $controller->getRequest(),
            $controller->url()
        );

        $defaultOrder = $this->builder->getDefaultOrder();
        $sorter->setDefaultOrder(
            $defaultOrder['sortBy'], $defaultOrder['sortOrder']
        );
        $this->form->setName($scopeName);

        foreach ($columns as $column)
        {
            $value = $values[$column];
            $spec
                = [
                'name'       => $column,
                'type'       => $formElements[$column],
                'options'    => [
                    'label' => $column,
                ],
                'attributes' => [
                    'id'           => $scopeName . '_' . $column,
                    'value'        => $value,
                    'class'        => 'form-control',
                    'autocomplete' => 'off',
                ],
            ];
            $this->form->add($spec);
        }

        $this->form->add(
            [
                'name'       => 'apply_filters',
                'type'       => 'submit',
                'options'    => [
                    'label' => __('Search'),
                ],
                'attributes' => [
                    'class' => 'btn btn-success btn-sm',
                    'role'  => 'button',
                    'value' => __('Search'),
                    'id'    => 'apply_filters',
                ],
            ]
        );

        $this->form->add(
            [
                'name'       => 'reset_filters',
                'type'       => 'submit',
                'options'    => [
                    'label' => __('Reset'),
                ],
                'attributes' => [
                    'class' => 'btn btn-default btn-sm',
                    'role'  => 'button',
                    'value' => __('Reset'),
                    'id'    => 'reset_filters',
                ],
            ]
        );

        $this->form->prepare();
        $this->sorterLinks = $sorter;

        return $this;
    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return mixed
     */
    public function getSorterLinks()
    {
        return $this->sorterLinks;
    }


}