<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'library' => '/assets/wellcart-base/js/lib/require.js',
    'config'  => [
        'baseUrl' => '/',
        'paths'   => [
            'wellcart'               => 'assets/wellcart-base/js/wellcart',
            'handlebars'             => 'assets/lib/handlebars/handlebars.runtime',
            'jquery'                 => 'assets/lib/jquery/jquery.min',
            'jquery-ui'              => 'assets/lib/jquery-ui/jquery-ui.min',
            'jquery-ujs'             => 'assets/wellcart-base/js/lib/jquery-ujs',
            'jquery-cookie'          => 'assets/lib/jquery-cookie/jquery.cookie',
            'tinymce'                => 'assets/lib/tinymce/tinymce.min',
            'ember'                  => 'assets/lib/ember/ember.min',
            'ember-data'             => 'assets/lib/ember-data/ember-data.min',
            'moment'                 => 'assets/lib/moment/min/moment-with-locales.min',
            'bootstrap'              => 'assets/lib/bootstrap/js/bootstrap.min',
            'sluggable'              => 'assets/wellcart-base/js/lib/speakingurl',
            'FastClick'              => 'assets/wellcart-base/js/lib/fastclick',
            'datetimepicker'         => 'assets/lib/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min',
            'daterangepicker'        => 'assets/wellcart-base/js/plugin/daterangepicker/daterangepicker',
            'bootbox'                => 'assets/wellcart-base/js/plugin/bootbox',
            'icheck'                 => 'assets/wellcart-base/js/plugin/icheck/icheck',
            'bootstrap-switch'       => 'assets/wellcart-base/js/plugin/bootstrap-switch/bootstrap-switch',
            'switchery'              => 'assets/wellcart-base/js/plugin/switchery/switchery',
            'nanoscroller'           => 'assets/wellcart-base/js/plugin/nanoscroller/nanoscroller',
            'chosen'                 => 'assets/lib/chosen/js/chosen.jquery.min',
            'jquery.validate.min'    => 'assets/wellcart-base/js/lib/validation/jquery.validate',
            '../jquery.validate.min' => 'assets/wellcart-base/js/lib/validation/jquery.validate',
            './jquery.validate.min'  => 'assets/wellcart-base/js/lib/validation/jquery.validate',
        ],
        'shim'    => [
            'jquery'           => [
                'exports' => '$'
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
            'ember'            => [
                'deps'    => ['jquery', 'handlebars'],
                'exports' => 'Ember',
            ],
            'ember-data'       => [
                'deps'    => ['ember'],
                'exports' => 'DS',
            ],
            'icheck'           => [
                'deps' => ['jquery'],
            ],
            'nanoscroller'     => [
                'deps' => ['jquery'],
            ],
            'chosen'           => [
                'deps' => ['jquery'],
            ],
            'bootstrap-switch' => [
                'deps'    => ['jquery'],
                'exports' => 'bootstrapSwitch',
            ],
            'FastClick'        => ['exports' => 'FastClick'],
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
            'bootbox',
            'icheck',
            'bootstrap-switch',
            'assets/wellcart-base/js/helpers',
        ],
    ],
];
