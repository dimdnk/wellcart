<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

$env = getenv('WELLCART_CONTAINER_ENV');
return [
    'session' => [
        'config'     => [
            'class'   => 'Zend\Session\Config\SessionConfig',
            'options' => [
                'name'           => 'wellcart_frontend_sid',
                'gc_probability' => 1,
                'save_path'      => (!$env) ? WELLCART_STORAGE_PATH
                    . 'sessions/' : sys_get_temp_dir(),
            ],
        ],
        'storage'    => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => [
            [
                'Zend\Session\Validator\RemoteAddr',
                'Zend\Session\Validator\HttpUserAgent',
            ],
        ],
    ]
];
