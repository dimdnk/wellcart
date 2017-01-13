<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\User\Form;

$forms = [
    Form\AccountPreferences::NAME => [
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
    ],
];