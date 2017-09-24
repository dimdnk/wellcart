<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\Catalog\Form;

$forms = [
    Form\Attribute::NAME => [
        'save' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'save_and_continue_edit' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check-circle',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],
        'attribute'              => [
            'backend_name'      => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'product_templates' => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'sort_order'        => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],

            'add_new_attribute_value' => [
                'options' => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-md-offset-4',
                    'fontAwesome' => ['icon' => 'plus-circle'],
                ],
            ],

            'translations' => [
                'name' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
            'values'       => [

                'sort_order' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'remove'     => [
                    'options' => [
                        'twb-layout'       => 'inline',
                        'column-size'      => 'md-2',
                        'fontAwesome'      => [
                            'icon' => 'remove',
                        ],
                        'label_attributes' => [
                            'class' => 'inline-label',
                        ],
                    ],
                ],

                'translations' => [
                    'name' => [
                        'options' => [
                            'twb-layout'       => 'horizontal',
                            'column-size'      => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    Form\Brand::NAME    => [
        'save' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'save_and_continue_edit' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check-circle',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'name' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'image' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'meta_title' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'meta_keywords' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'meta_description' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'remove_image' => [
            [
                'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-12',
                    'label_attributes' => [
                        'class' => 'col-md-8 col-md-offset-4',
                    ],
                ],
                'attributes' => [
                    'class' => 'icheck-element',
                ],
            ],
        ],
    ],
    Form\Category::NAME => [
        'save' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'save_and_continue_edit' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check-circle',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],
        'category'               => [
            'parent'       => [
                'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'class' => 'chosen-element',
                ],
            ],
            'is_visible'   => [
                'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'class' => 'chosen-element',
                ],
            ],
            'url_key'      => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],

            ],
            'translations' => [
                'name'             => [
                    'options'    => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                    'attributes' => [
                        'class' => 'form-control catalog_category_name',
                    ],
                ],
                'description'      => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'meta_title'       => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'meta_keywords'    => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'meta_description' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
        ],
    ],

    Form\Feature::NAME => [
        'save' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'save_and_continue_edit' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check-circle',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],
        'feature'                => [
            'backend_name'      => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'product_templates' => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'sort_order'        => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],

            'add_new_feature_value' => [
                'options' => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-md-offset-4',
                    'fontAwesome' => ['icon' => 'plus-circle'],
                ],

            ],

            'translations' => [
                'name' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
            'values'       => [
                'sort_order' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'remove'     => [
                    'options' => [
                        'twb-layout'       => 'inline',
                        'column-size'      => 'md-2',
                        'fontAwesome'      => [
                            'icon' => 'remove',
                        ],
                        'label_attributes' => [
                            'class' => 'inline-label',
                        ],
                    ],
                ],

                'translations' => [
                    'name' => [
                        'options' => [
                            'twb-layout'       => 'horizontal',
                            'column-size'      => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                ],
            ],
        ],
    ],

    Form\Product::NAME => [
        'options' => [
            'tabs' => [
                'general'    => [
                    'label'    => 'General',
                    'options'  => ['layout' => '2columns'],
                    'elements' => [
                        'product.product_template'=> ['options' => ['tab' => 'general-left']],
                        'product.translations'    => ['options' => ['tab' => 'general-left']],
                        'product.status'          => ['options' => ['tab' => 'general-right']],
                        'product.brand'           => ['options' => ['tab' => 'general-right']],
                        'product.url_key'         => ['options' => ['tab' => 'general-right']],
                        'product.add_new_variant' => ['options' => ['tab' => 'general-right']],
                        'product.variants'        => ['options' => ['tab' => 'general-right']],
                    ],
                ],
                'features'   => [
                    'label'    => 'Features',
                    'elements' => [
                        'product.add_feature',
                        'product.features',
                    ],
                ],
                'categories' => [
                    'label'    => 'Categories',
                    'elements' => [
                        'product.categories',
                    ],
                ],
                'images'     => [
                    'label'    => 'Images',
                    'elements' => [
                        'product.add_new_image',
                        'product.images',
                    ],
                ],
            ],
        ],
        'save'    => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'save_and_continue_edit' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check-circle',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'product' => [
            'product_template' => [
                'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'class' => 'chosen-element',
                ],
            ],
            'status'           => [
                'options'    => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-md-offset-4',
                ],
                'attributes' => [
                    'class' => 'switchery-element',
                ],
            ],
            'url_key'          =>
                [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            'add_feature'      =>
                [
                    'options'    => [
                        'icon'        => 'fa fa-plus',
                        'class'       => 'btn btn-primary btn-sm',
                        'twb-layout'  => 'horizontal',
                        'column-size' => 'md-12',
                    ],
                    'attributes' => [
                        'id' => 'catalog_add_feature',
                    ],
                ],
            'features'         => [
                'options' => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8',
                ],
            ],

            'categories'      => [
                'options' => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-sm-12',
                ],
            ],
            'brand'           => [
                'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'class' => 'chosen-element',
                ],
            ],
            'add_new_variant' => [
                'options'    => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-md-offset-4',
                    'fontAwesome' => ['icon' => 'plus-circle'],
                ],
                'attributes' => [
                    'class' => 'btn btn-default btn-create-new-row',
                ],
            ],
            'variants'        => [
                'remove'   => [
                    'options'    => [
                        'twb-layout'       => 'inline',
                        'column-size'      => 'md-2',
                        'fontAwesome'      => [
                            'icon' => 'remove',
                        ],
                        'label_attributes' => [
                            'class' => 'inline-label',
                        ],
                    ],
                    'attributes' => [
                        'class' => 'btn-remove-row btn btn-danger btn-xs',
                    ],
                ],
                'quantity' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'price'    => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'sku'      => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
            'translations'    => [
                'name'             => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'description'      => [
                    'options'    => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                    'attributes' => [
                        'class' => 'wysiwyg-tinymce',
                    ],
                ],
                'meta_title'       => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'meta_keywords'    => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'meta_description' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
            'add_new_image'   => [
                'options'    => [
                    'twb-layout'  => 'horizontal',
                    'column-size' => 'md-8 col-md-offset-4',
                    'fontAwesome' => ['icon' => 'plus-circle'],
                ],
                'attributes' => [
                    'class' => 'btn btn-default btn-create-new-row',
                ],
            ],
            'images'          => [
                'remove'      => [
                    'options'    => [
                        'twb-layout'       => 'inline',
                        'column-size'      => 'md-2',
                        'fontAwesome'      => [
                            'icon' => 'remove',
                        ],
                        'label_attributes' => [
                            'class' => 'inline-label',
                        ],
                    ],
                    'attributes' => [
                        'class' => 'btn-remove-row btn btn-danger btn-xs',
                    ],
                ],
                'description' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
                'image'       => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
        ],
    ],

    Form\ProductTemplate::NAME => [
        'save' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'save_and_continue_edit' => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check-circle',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'product_template' => [
            'sort_order'   => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'attributes'   => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'features'     => [
                'options' => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
            ],
            'translations' => [
                'name' => [
                    'options' => [
                        'twb-layout'       => 'horizontal',
                        'column-size'      => 'md-8',
                        'label_attributes' => [
                            'class' => 'col-md-4',
                        ],
                    ],
                ],
            ],
        ],
    ],
];


return [
    'ui' => [
        'component' => [
            'form' => $forms,
        ],
    ],
];
