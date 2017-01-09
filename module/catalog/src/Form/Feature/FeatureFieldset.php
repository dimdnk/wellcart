<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Feature;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureI18nEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\FeatureValueI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class FeatureFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        FeatureEntity $featurePrototype,
        FeatureI18nEntity $featureI18nPrototype,
        FeatureValueEntity $featureValuePrototype,
        FeatureValueI18nEntity $featureValueI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('feature');

        $this->setHydrator($hydrator)
            ->setObject($featurePrototype);
        $this->setAttribute('class', 'feature-fieldset');

        $this->add(
            [
                'name'       => 'backend_name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Description'),
                    'help-block'       => __(
                        'Internal name for administrators.'
                    )
                ],
                'attributes' => [
                    'class' => 'form-control catalog_feature_backend_name',
                ],
            ],
            ['priority' => 900]
        );

        $this->add(
            [
                'name'       => 'product_templates',
                'type'       => 'catalogProductTemplatesMultiCheckboxSelector',
                'options'    => [
                    'label'            => __('Product Templates')
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_feature_product_templates',
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
                    'target_element' => new FeatureI18nFieldset(
                        $factory,
                        $hydrator,
                        $featureI18nPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'feature-i18n',
                ]
            ],
            ['priority' => 750]
        );


        $this->add(
            [
                'name'       => 'sort_order',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Sort Order')

                ],
                'attributes' => [
                    'id'    => 'catalog_feature_sort_order',
                    'value' => 0,
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'type'       => 'button',
                'name'       => 'add_new_feature_value',
                'options'    => [
                    'label'       => __('Add Feature Value')
                ],
                'attributes' => [
                    'id'               => 'catalog_feature_add_new_feature_value',
                    'class'            => 'btn btn-default btn-create-new-row',
                    'data-source-path' => 'fieldset.feature-values',
                    'data-target-path' => 'fieldset.feature-values  tbody.table-fieldset-body',
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
                    'target_element'         => new FeatureValueFieldset(
                        $factory,
                        $hydrator,
                        $featureValuePrototype,
                        $featureValueI18nPrototype
                    ),

                    'columns'     => [
                        ['element_name' => 'translations',
                         'label'        => __('Name'),
                         'width'        => 48,],
                        ['element_name' => 'sort_order',
                         'label'        => __('Sort Order'),
                         'width'        => 48,],
                    ],
                    'row_actions' => [
                        ['element_name' => 'remove'],
                    ],
                ],
                'attributes' => [
                    'class' => 'feature-values',
                ]
            ]
        );
    }


    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof FeatureEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\FeatureEntity'
            );
        }
        return parent::setObject($object);
    }
}
