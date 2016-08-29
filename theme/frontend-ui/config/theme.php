<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'description'  => 'WellCart Frontend Foundation Design Theme',
    'version'      => '0.1.0',
    /**
     * Template map
     */
    'template_map' => [
        'layout/page-fixed-1column'      => __DIR__
            . '/../view/layout/page-fixed-1column.phtml',
        'layout/page-fluid-1column'      => __DIR__
            . '/../view/layout/page-fluid-1column.phtml',

        'layout/empty'                   => __DIR__
            . '/../view/layout/empty.phtml',
        'layout/mail/page-fixed-1column' => __DIR__
            . '/../view/layout/mail/page-fixed-1column.phtml',
    ],
];
