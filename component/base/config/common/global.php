<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use Zend\Http\Response;

return [
    'wellcart' => [
        'website'              => [
            'name' => 'Demo Application',
        ],
        'maintenance'          => [
            'message'     => 'Service Temporarily Unavailable',
            'status_code' => Response::STATUS_CODE_503,
            'template'    => __DIR__ . '/../../data/Maintenance.html',
        ],
        'localization'         =>
            [
                'country_code' => 'GB',
                'timezone'     => 'Etc/GMT',
                'locale'       => 'en_US',
            ],
        'email_communications' => [
            'enabled'  => true,
            'contacts' => [
                'general'               => [
                    'name'  => 'Default Website Owner',
                    'email' => 'owner@example.com',
                ],
                'support'               => [
                    'name'  => 'Default Website Customer Support',
                    'email' => 'support@example.com',
                ],
                'website_administrator' => [
                    'name'  => 'Default Website Administrator',
                    'email' => 'admin@example.com',
                ],
            ],
        ],
        'doctrine'             => ['global_cache_instance' => 'array',],
        'theme' => [],
    ],
];
