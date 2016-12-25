<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'description'  => 'WellCart Backend UI Design Theme',
    'version'      => '0.1.0',
    'parent'       => 'wellcart-frontend-ui',
    /**
     * Template map
     */
    'template_map' => [
        'layout/page-fluid-1column'  => __DIR__
            . '/../view/layout/page-fluid-1column.phtml',
        'layout/page-fluid-2columns' => __DIR__
            . '/../view/layout/page-fluid-2columns.phtml',
    ],
];
