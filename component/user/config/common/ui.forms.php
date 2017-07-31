<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\User\Form;

$forms = [
    Form\Account::NAME => [
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

        'email' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],


        'roles' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
            'attributes' => [
                'class' => 'icheck-element',
          ],
        ],

        'language' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'time_zone' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'first_name' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'last_name' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'password' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],

        'passwordVerify' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ],
    ],


    Form\Acl\Role::NAME => [
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

        'is_default' => [
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

        'name' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
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

        'permissions' => [
            'options'    => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-8',
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
          'attributes' => [
            'class' => 'icheck-element',
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
