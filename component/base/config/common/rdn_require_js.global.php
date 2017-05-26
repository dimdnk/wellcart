<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'rdn_require_js' =>
        [
            'library' => '/assets/lib/web/require.js',
            'config'  => [
                'baseUrl' => '/',
                'paths'   => [
                    'wellcart'               => 'assets/wellcart-base/js/wellcart',
                    'jquery'                 => 'assets/lib/jquery/jquery.min',
                    'jquery-ui'              => 'assets/lib/jquery-ui/jquery-ui.min',
                    'jquery-ujs'             => 'assets/lib/web/jquery-ujs',
                    'jquery-cookie'          => 'assets/lib/jquery-cookie/jquery.cookie',
                    'tinymce'                => 'assets/lib/tinymce/tinymce.min',
                    'moment'                 => 'assets/lib/moment/min/moment-with-locales.min',
                    'bootstrap'              => 'assets/lib/bootstrap/js/bootstrap.min',
                    'sluggable'              => 'assets/lib/web/speakingurl',
                    'datetimepicker'         => 'assets/lib/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min',
                    'daterangepicker'        => 'assets/lib/web/daterangepicker/daterangepicker',
                    'bootbox'                => 'assets/lib/web/bootbox',
                    'icheck'                 => 'assets/lib/web/icheck/icheck',
                    'bootstrap-switch'       => 'assets/lib/web/bootstrap-switch/bootstrap-switch',
                    'switchery'              => 'assets/lib/web/switchery/switchery',
                    'chosen'                 => 'assets/lib/chosen/js/chosen.jquery.min',
                    'jquery.validate.min'    => 'assets/lib/web/validation/jquery.validate',
                    '../jquery.validate.min' => 'assets/lib/web/validation/jquery.validate',
                    './jquery.validate.min'  => 'assets/lib/web/validation/jquery.validate',
                ],
                'shim'    => [
                    'jquery'           => [
                        'exports' => '$',
                    ],
                    'jquery-ui'        => [
                        'deps' => ['jquery'],
                    ],
                    'bootstrap'        => [
                        'deps'    => ['jquery'],
                        'exports' => 'bootstrap',
                    ],
                    'switchery'        => [
                        'exports' => 'Switchery',
                    ],
                    'bootbox'          => [
                        'exports' => 'bootbox',
                    ],
                    'icheck'           => [
                        'deps' => ['jquery'],
                    ],
                    'chosen'           => [
                        'deps' => ['jquery'],
                    ],
                    'bootstrap-switch' => [
                        'deps'    => ['jquery'],
                        'exports' => 'bootstrapSwitch',
                    ],
                    'tinymce'          => ['exports' => 'tinymce'],
                    'moment'           => ['exports' => 'moment'],
                    'datetimepicker'   => [
                        'deps' => ['jquery'],
                    ],
                    'daterangepicker'  => [
                        'deps' => ['jquery'],
                    ],
                    'wellcart'         => [
                        'deps'    => [],
                        'exports' => 'WellCart',
                    ],
                ],
                'deps'    => [
                    'wellcart',
                    'jquery',
                    'icheck',
                    'bootstrap-switch',
                    'assets/wellcart-base/js/helpers',
                ],
            ],
        ],
];
