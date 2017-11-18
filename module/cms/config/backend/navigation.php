<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'navigation' => [
        'backend_main_navigation' => [
            'backend:content-section' => [
                'label' => 'Content',
                'icon'  => 'icon-folder5',
                'route' => 'backend/cms/pages',
                'pages' => [
                    'backend/cms/pages' => [
                        'label'  => 'Pages',
                        'route'  => 'backend/cms/pages',
                        'action' => 'list',
                    ],
                ],
            ],
        ],
    ],
];
