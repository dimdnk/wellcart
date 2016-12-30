<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'translator' =>
        [
            'locale'                =>
                ['default_locale'  => 'en_US',
                 'fallback_locale' => 'en_US'
                ],
            'event_manager_enabled' => false,
            /**
             * 'cache'                     => array(
             * 'adapter' => array(
             * 'name' => 'filesystem'
             * ),
             * 'plugins' => array(
             * 'serializer'        => [],
             * 'exception_handler' => array('throw_exceptions' => true),
             * ),
             * 'options' => array(
             * 'ttl'                => 86400,
             * 'cache_dir'          => WELLCART_STORAGE_PATH . 'cache/',
             * 'dir_level'          => 1,
             * 'dir_permission'     => 0766,
             * 'file_permission'    => 0666,
             * 'umask'              => 0,
             * 'namespaceSeparator' => '-base-translator-',
             * ),
             * ),
             */

            'translation_file_patterns' => [
                __FILE__ => [
                    'text_domain' => 'default',
                    'type'        => 'gettext',
                    'base_dir'    => __DIR__ . '/../../language',
                    'pattern'     => '%s.mo',
                ],
            ],
        ]
];
