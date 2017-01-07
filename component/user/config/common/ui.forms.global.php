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
                'user_account' => [
                    'elements' => [
                        'save'                   => [
                            'options'    => [
                                'fontAwesome' => [
                                    'icon' => 'check'
                                ],
                            ],
                            'attributes' => [
                                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                            ],
                        ],

                        'save_and_continue_edit' => [
                            'options'    => [
                                'fontAwesome' => [
                                    'icon' => 'check-circle'
                                ],
                            ],
                            'attributes' => [
                                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                            ],
                        ]
                    ],
                ],
            ]
    ]
];
