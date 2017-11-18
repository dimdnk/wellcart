<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Product;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\FeatureCombinationEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductI18nEntity;
use WellCart\Catalog\Spec\ProductImageEntity;
use WellCart\Catalog\Spec\ProductVariantEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class ProductFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductEntity $productPrototype,
        ProductI18nEntity $productTranslationPrototype,
        ProductVariantEntity $productVariantPrototype,
        FeatureCombinationEntity $productFeatureCombinationPrototype,
        ProductImageEntity $productImagePrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('product');

        $this->setHydrator($hydrator)
            ->setObject($productPrototype);
        $this->setAttribute('class', 'product-fieldset');

        $this->add(
            [
                'name'       => 'product_template',
                'type'       => 'catalogProductTemplatesSelector',
                'options'    => [
                    'label' => __('Template'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_product_product_template',
                ],
            ],
            ['priority' => 1450]
        );

        $this->add(
            [
                'type'       => 'translatableCollection',
                'name'       => 'translations',
                'options'    => [
                    'allow_remove'   => true,
                    'target_element' => new ProductI18nFieldset(
                        $factory,
                        $hydrator,
                        $productTranslationPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'product-translations',
                ],
            ],
            ['priority' => 1500]
        );


        $this->add(
            [
                'name'       => 'brand',
                'type'       => 'catalogBrandSelector',
                'options'    => [
                    'label' => __('Brand'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_product_brand',
                ],
            ],
            ['priority' => 1450]
        );

        if (!count($this->get('brand')->getValueOptions())) {
            $this->remove('brand');
        }

        $this->add(
            [
                'name'       => 'status',
                'type'       => 'Checkbox',
                'options'    => [
                    'label'              => __('Online'),
                    'value_options'      => [
                        0 => __('Disable'),
                        1 => __('Enable'),
                    ],
                    'use_hidden_element' => true,
                    'checked_value'      => 1,
                    'unchecked_value'    => 0,
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_product_status',
                ],
            ],
            ['priority' => 1400]
        );


        $this->add(
            [
                'name'       => 'url_key',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('URL Key'),
                ],
                'attributes' => [
                    'id'               => 'catalog_product_url_key',
                    'data-sluggable'   => 'true',
                    'data-slug-source' => '.catalog_product_name:first',
                    'required'         => 'required',
                ],
            ],
            ['priority' => 1100]
        );

        $this->add(
            [
                'name'       => 'add_feature',
                'type'       => 'htmlAnchor',
                'options'    => [
                    'link'   => url_to_route(
                        'backend/catalog/features',
                        [
                            'action' => 'create',
                        ]
                    ),
                    'text'   => __('Add feature'),
                    'target' => '_blank',
                ],
                'attributes' => [
                    'id' => 'catalog_add_feature',
                ],
            ],
            ['priority' => 1040]
        );

        $this->add(
            [
                'name'       => 'features',
                'type'       => 'catalogFeatureCombinationMultiCheckbox',
                'options'    => [
                    'disable_inarray_validator' => true,
                    'unselected_value'          => null,

                ],
                'attributes' => [
                    'required' => false,
                    'id'       => 'catalog_product_features',
                ],
            ],
            ['priority' => 1040]
        );
        $this->get('features')->disableValidator();

        $this->add(
            [
                'name'       => 'categories',
                'type'       => 'catalogCategorySelector',
                'options'    => [
                    'disable_inarray_validator' => true,
                    'unselected_value'          => null,
                ],
                'attributes' => [
                    'required'     => false,
                    'autocomplete' => 'off',
                    'multiple'     => true,
                    'id'           => 'catalog_product_categories',
                ],
            ],
            ['priority' => 1050]
        );
        $this->get('categories')->disableValidator();

        $this->add(
            [
                'type'       => 'button',
                'name'       => 'add_new_variant',
                'options'    => [
                    'label' => __('Add Variant'),
                ],
                'attributes' => [
                    'id'               => 'catalog_product_add_new_variant',
                    'data-source-path' => 'fieldset.product-variants',
                    'data-target-path' => 'fieldset.product-variants  tbody.table-fieldset-body',
                ],
            ],
            ['priority' => 1000]
        );

        $this->add(
            [
                'type'       => 'button',
                'name'       => 'add_new_image',
                'options'    => [
                    'label' => __('Add Image'),
                ],
                'attributes' => [
                    'id'               => 'catalog_product_add_new_image',
                    'data-source-path' => 'fieldset.product-images',
                    'data-target-path' => 'fieldset.product-images  tbody.table-fieldset-body',
                ],
            ],
            ['priority' => 1000]
        );

        $this->add(
            [
                'type'       => 'tableFieldsetCollection',
                'name'       => 'variants',
                'options'    => [
                    'count'                  => 1,
                    'should_create_template' => true,
                    'allow_add'              => true,
                    'target_element'         => new VariantsFieldset(
                        $factory,
                        $hydrator,
                        $productVariantPrototype
                    ),
                    'columns'                => [
                        ['element_name' => 'sku',
                         'label'        => __('SKU'),
                         'width'        => 36,
                        ],
                        ['element_name' => 'quantity',
                         'label'        => __('Quantity'),
                         'width'        => 20,
                        ],
                        ['element_name' => 'price',
                         'label'        => __('Price'),
                         'width'        => 34,
                        ],

                    ],
                    'row_actions'            => [
                        ['element_name' => 'remove'],
                    ],
                ],
                'attributes' => [
                    'class' => 'product-variants',
                ],
            ],
            ['priority' => 950]
        );


        $this->add(
            [
                'type'       => 'tableFieldsetCollection',
                'name'       => 'images',
                'options'    => [
                    'count'                  => 0,
                    'should_create_template' => true,
                    'allow_add'              => true,
                    'target_element'         => new ImagesFieldset(
                        $factory,
                        $hydrator,
                        $productImagePrototype
                    ),
                    'columns'                => [
                        ['element_name' => 'product_id', 'width' => 4,],
                        ['element_name' => 'image', 'label' => __('Image'),
                         'width'        => 30,],
                        ['element_name' => 'description',
                         'label'        => __('Description'),
                         'width'        => 60,],
                    ],
                    'row_actions'            => [
                        ['element_name' => 'remove'],
                    ],
                ],
                'attributes' => [
                    'class' => 'product-images',
                ],
            ],
            ['priority' => 950]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ProductEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductEntity'
            );
        }

        return parent::setObject($object);
    }
}
