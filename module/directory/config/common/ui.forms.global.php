<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return ['ui' =>
    ['form' =>
        [
            'directory_country' => [
                'elements' => [
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

                    'status' => [
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
                    ],

                    'postcode_required' => [
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

                    'iso_code2' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],
                    'iso_code3' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'address_format' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],
                ],
            ],

            'directory_currency' => [
                'elements' => [
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

                    'title' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                        'attributes' => array(
                            'autofocus' => 'autofocus',
                        ),
                    ],
                    'code' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                    ],
                    'symbol' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                    ],
                    'symbol_position' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                    ],
                    'exchange_rate' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                    ],
                    'decimals' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                    ],
                    'decimals_separator' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        ),
                    ],
                    'thousands_separator' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => array(
                                'class' => 'col-md-4',
                            ),
                        )
                    ],
                    'status' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-12',
                            'label_attributes' => array(
                                'class' => 'col-md-8 col-md-offset-4',
                            ),

                        ),
                        'attributes' => array(
                            'class' => 'icheck-element',
                        ),
                    ],
                    'is_primary' => [
                        'options' => array(
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-12',
                            'label_attributes' => array(
                                'class' => 'col-md-8 col-md-offset-4',
                            ),
                        ),
                        'attributes' => array(
                            'class' => 'icheck-element',
                        ),
                    ],
                ],
            ],


            'directory_geo_zone' => [
                'elements' => [
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
                'geo_zone' => [
                    'elements' => [
                        'name' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8',
                                'label_attributes' => [
                                    'class' => 'col-md-4',
                                ],
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
                        'add_new_geo_zone' => [
                            'options' => [
                                'twb-layout' => 'horizontal',
                                'column-size' => 'md-8 col-md-offset-4',
                                'fontAwesome' => ['icon' => 'plus-circle'],
                            ],
                        ]
                    ],

                    'geo_zone_maps' => [
                        'elements' => [
                            'country' =>  [
                                'options'    => [
                                    'twb-layout'       => 'inline',
                                    'column-size'      => 'md-5',
                                    'label_attributes' => [
                                        'class' => 'inline-label',
                                    ],
                                ],
                                'attributes' => [
                                    'class' => 'country-selector',
                                ],
                            ],
                            'zone' =>  [
                                'options'    => [
                                    'twb-layout'       => 'inline',
                                    'column-size'      => 'md-5',
                                    'label_attributes' => [
                                        'class' => 'inline-label',
                                    ],
                                ],
                            ],
                            'remove' => [
                                'options'    => [
                                    'label'            => ' ',
                                    'twb-layout'       => 'inline',
                                    'column-size'      => 'md-2',
                                    'fontAwesome'      => [
                                        'icon' => 'remove'
                                    ],
                                    'label_attributes' => [
                                        'class' => 'inline-label',
                                    ],
                                ],
                                'attributes' => [
                                    'class' => 'btn-remove-row btn btn-danger btn-xs',
                                ],
                            ]
                        ]
                    ],

                ],

            ],

            'directory_zone' => [
                'elements' => [
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

                    'code' => [
                        'options' => [
                            'twb-layout' => 'horizontal',
                            'column-size' => 'md-8',
                            'label_attributes' => [
                                'class' => 'col-md-4',
                            ],
                        ],
                    ],

                    'status' => [
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
                    ],


                    'country' => [
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

                ],
            ],

        ]
    ]
];
