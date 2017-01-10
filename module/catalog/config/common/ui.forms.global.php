<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'ui' => [
        'form' =>
            [
                'catalog_attribute' => [
                    'save' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'save_and_continue_edit' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check-circle'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],
                    'attribute' => [
                            'backend_name' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'product_templates' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'sort_order' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],

                            'add_new_attribute_value' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8 col-md-offset-4',
                                    'fontAwesome' => ['icon' => 'plus-circle'],
                                ],
                        ],

                        'translations' => [
                                    'name' => [
                                        'options' => [
                                            'twb-layout' => 'horizontal',
                                            'column-size' => 'md-8',
                                            'label_attributes' => [
                                                'class' => 'col-md-4',
                                            ],
                                        ],
                                    ],
                        ],
                        'values' => [

                            'sort_order' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'remove' => [
                                'options' => [
                                    'twb-layout' => 'inline',
                                    'column-size' => 'md-2',
                                    'fontAwesome' => [
                                        'icon' => 'remove'
                                    ],
                                    'label_attributes' => [
                                        'class' => 'inline-label',
                                    ],
                                ]
                            ],

                            'translations' => [
                                'name' => [
                                    'options' => [
                                        'twb-layout' => 'horizontal',
                                        'column-size' => 'md-8',
                                        'label_attributes' => [
                                            'class' => 'col-md-4',
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ],
                ],

                'catalog_brand' => [
                    'save' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'save_and_continue_edit' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check-circle'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'name' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'image' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'meta_title' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'meta_keywords' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'meta_description' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'remove_image' => [
                        [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-12',
                                'label_attributes' => [
                                    'class' => 'col-md-8 col-md-offset-4',
                                ],
                            ],
                            'attributes' => [
                                'class' => 'icheck-element',
                            ],
                        ]
                    ],
                ],
                'catalog_category' => [
                    'save' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'save_and_continue_edit' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check-circle'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],
                    'category' => [
                        'parent' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
                            ],
                            'attributes' => [
                                'class' => 'chosen-element',
                            ],
                        ],
                        'is_visible' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
                            ],
                            'attributes' => [
                                'class' => 'chosen-element',
                            ],
                        ],
                        'url_key' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
                            ],

                        ],
                        'translations' => [
                            'name' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                                'attributes' => [
                                    'class' => 'form-control catalog_category_name',
                                ],
                            ],
                            'description' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'meta_title' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'meta_keywords' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'meta_description' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],

                'catalog_feature' => [
                    'save' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'save_and_continue_edit' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check-circle'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],
                    'feature' => [
                        'backend_name' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
                            ],
                        ],
                        'product_templates' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
                            ],
                        ],
                        'sort_order' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
                            ],
                        ],

                        'add_new_feature_value' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8 col-md-offset-4',
                                'fontAwesome' => ['icon' => 'plus-circle'],
                            ],

                        ],

                        'translations' => [
                            'name' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                        ],
                        'values' => [
                            'sort_order' => [
                                'options' => [
                                    'twb-layout' => 'horizontal',
                                    'column-size' => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                            ],
                            'remove' => [
                                'options' => [
                                    'twb-layout' => 'inline',
                                    'column-size' => 'md-2',
                                    'fontAwesome' => [
                                        'icon' => 'remove'
                                    ],
                                    'label_attributes' => [
                                        'class' => 'inline-label',
                                    ],
                                ]
                            ],

                            'translations' => [
                                'name' => [
                                    'options' => [
                                        'twb-layout' => 'horizontal',
                                        'column-size' => 'md-8',
                                        'label_attributes' => [
                                            'class' => 'col-md-4',
                                        ],
                                    ],
                                ],

                            ],
                        ]
                    ],
                ],

                'catalog_product' => [
                    'save' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'save_and_continue_edit' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check-circle'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],
                ],

                'catalog_product_template' => [
                    'save' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ],

                    'save_and_continue_edit' => [
                        'options' => [
                            'fontAwesome' => [
                                'icon' => 'check-circle'
                            ],
                        ],
                        'attributes' => [
                            'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                        ],
                    ]
                ],

            ]
    ]
];
