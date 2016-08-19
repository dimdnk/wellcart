<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'backend/wellcart-backend-ui' => [
        'cms/pages/form' => [
            'helpers' => [
                'requireJS' => [
                    'assets/wellcart-base/js/tinymce' => ['dependencies' => ['assets/wellcart-base/js/tinymce']],
                ]
            ],
        ],
    ],
];
