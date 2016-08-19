<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'config'     => [
        'class'   => 'Zend\Session\Config\SessionConfig',
        'options' => [
            'name'           => 'wellcart_frontend_sid',
            'gc_probability' => 1,
            'save_path'      => WELLCART_STORAGE_PATH . 'sessions/',
        ],
    ],
    'storage'    => 'Zend\Session\Storage\SessionArrayStorage',
    'validators' => [
        [
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ],
    ],
];
