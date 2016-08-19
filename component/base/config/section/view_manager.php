<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'base_path'                => '/',
    'display_not_found_reason' => false,
    'display_exceptions'       => false,
    'doctype'                  => 'HTML5',
    'layout'                   => 'layout/page-fixed-1column',
    'not_found_template'       => 'error/404',
    'exception_template'       => 'error/index',
    'template_map'             => include __DIR__ . '/template_map.php',
    'template_path_stack'      => [],
    'strategies'               => [
        'ViewJsonStrategy' => 'ViewJsonStrategy',
        'ViewFeedStrategy' => 'ViewFeedStrategy',
    ],
];
