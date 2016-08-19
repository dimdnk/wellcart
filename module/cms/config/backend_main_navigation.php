<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'zfcadmin:content-section' => [
        'label' => 'Content',
        'icon'  => 'icon-folder5',
        'route' => 'zfcadmin/cms/pages',
        'pages' => [
            'zfcadmin/cms/pages' => [
                'label'  => 'Pages',
                'route'  => 'zfcadmin/cms/pages',
                'action' => 'list',
            ],
        ]
    ],
];
