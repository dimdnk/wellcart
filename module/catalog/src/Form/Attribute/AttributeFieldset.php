<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Attribute;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeI18nEntity;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\AttributeValueI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class AttributeFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        AttributeEntity $attributePrototype,
        AttributeI18nEntity $attributeI18nPrototype,
        AttributeValueEntity $attributeValuePrototype,
        AttributeValueI18nEntity $attributeValueI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('attribute');

        $this->setHydrator($hydrator)
            ->setObject($attributePrototype);
        $this->setAttribute('class', 'attribute-fieldset');

        $this->add(
            [
                'name'       => 'backend_name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Description'),
                    'help-block'       => __(
                        'Internal name for administrators.'
                    ),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'class' => 'form-control catalog_attribute_backend_name',
                ],
            ],
            ['priority' => 900]
        );

        $this->add(
            [
                'name'       => 'product_templates',
                'type'       => 'catalogProductTemplatesMultiCheckboxSelector',
                'options'    => [
                    'label'            => __('Product Templates'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_attribute_product_templates',
                ],
            ],
            ['priority' => 600]
        );


        $this->add(
            [
                'type'       => 'translatableCollection',
                'name'       => 'translations',
                'options'    => [
                    'allow_remove'   => true,
                    'target_element' => new AttributeI18nFieldset(
                        $factory,
                        $hydrator,
                        $attributeI18nPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'attribute-i18n',
                ]
            ],
            ['priority' => 750]
        );


        $this->add(
            [
                'name'       => 'sort_order',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Sort Order'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'    => 'catalog_attribute_sort_order',
                    'value' => 0,
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'type'       => 'button',
                'name'       => 'add_new_attribute_value',
                'options'    => [
                    'label'       => __('Add Attribute Value'),
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-md-offset-4',
                    'fontAwesome' => ['icon' => 'plus-circle'],
                ],
                'attributes' => [
                    'id'               => 'catalog_attribute_add_new_attribute_value',
                    'class'            => 'btn btn-default btn-create-new-row',
                    'data-source-path' => 'fieldset.attribute-values',
                    'data-target-path' => 'fieldset.attribute-values  tbody.table-fieldset-body',
                ],
            ]
        );

        $this->add(
            [
                'type'       => 'tableFieldsetCollection',
                'name'       => 'values',
                'options'    => [
                    'count'                  => 0,
                    'should_create_template' => true,
                    'allow_remove'           => true,
                    'target_element'         => new AttributeValueFieldset(
                        $factory,
                        $hydrator,
                        $attributeValuePrototype,
                        $attributeValueI18nPrototype
                    ),

                    'columns'                => [
                        ['element_name' => 'translations',
                         'label'        => __('Name'),
                         'width'        => 78,],
                        ['element_name' => 'sort_order',
                         'label'        => __('Sort Order'),
                         'width'        => 18,],
                    ],
                    'row_actions'            => [
                        ['element_name' => 'remove'],
                    ],
                ],
                'attributes' => [
                    'class' => 'attribute-values',
                ]
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof AttributeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\AttributeEntity'
            );
        }
        return parent::setObject($object);
    }
}
