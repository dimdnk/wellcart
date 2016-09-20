<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'library' => '/assets/lib/web/require.js',
    'config'  => [
        'baseUrl' => '/',
        'paths'   => [
            'wellcart'               => 'assets/wellcart-base/js/wellcart',
            'handlebars'             => 'assets/lib/handlebars/handlebars.runtime',
            'underscore'             => 'assets/lib/underscore/underscore-min',
            'backbone'               => 'assets/lib/web/backbone',
            'backbone.radio'         => 'assets/lib/web/backbone.radio',
            'backbone.marionette'    => 'assets/lib/web/backbone.marionette',
            'marionette'             => 'assets/lib/web/backbone.marionette',
            'jquery'                 => 'assets/lib/jquery/jquery.min',
            'jquery-ui'              => 'assets/lib/jquery-ui/jquery-ui.min',
            'jquery-ujs'             => 'assets/lib/web/jquery-ujs',
            'jquery-cookie'          => 'assets/lib/jquery-cookie/jquery.cookie',
            'tinymce'                => 'assets/lib/tinymce/tinymce.min',
            'moment'                 => 'assets/lib/moment/min/moment-with-locales.min',
            'bootstrap'              => 'assets/lib/bootstrap/js/bootstrap.min',
            'sluggable'              => 'assets/lib/web/speakingurl',
            'FastClick'              => 'assets/lib/web/fastclick',
            'datetimepicker'         => 'assets/lib/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min',
            'daterangepicker'        => 'assets/lib/web/daterangepicker/daterangepicker',
            'bootbox'                => 'assets/lib/web/bootbox',
            'icheck'                 => 'assets/lib/web/icheck/icheck',
            'bootstrap-switch'       => 'assets/lib/web/bootstrap-switch/bootstrap-switch',
            'switchery'              => 'assets/lib/web/switchery/switchery',
            'nanoscroller'           => 'assets/lib/web/nanoscroller/nanoscroller',
            'chosen'                 => 'assets/lib/chosen/js/chosen.jquery.min',
            'jquery.validate.min'    => 'assets/lib/web/validation/jquery.validate',
            '../jquery.validate.min' => 'assets/lib/web/validation/jquery.validate',
            './jquery.validate.min'  => 'assets/lib/web/validation/jquery.validate',
        ],
        'shim'    => [
            'jquery'     => [
                'exports' => '$'
            ],
            'underscore' => [
                'exports' => '_',
            ],
            'backbone'   => [
                'deps'    => ['jquery', 'underscore'],
                'exports' => 'Backbone',
            ],
            'marionette' => [
                'deps'    => ['backbone', 'backbone.radio'],
                'exports' => 'Marionette',
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
            'icheck',
            'bootstrap-switch',
            'assets/wellcart-base/js/helpers',
        ],
    ],
];
