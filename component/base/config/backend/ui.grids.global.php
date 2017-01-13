<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\Base\PageView;

$grids = [
    PageView\Backend\UrlRewritesGrid::NAME => [],
    PageView\Backend\LanguagesGrid::NAME => [],
];
return [
    'ui' => [
        'component' => [
            'gird' => $grids,
        ],
    ],
];
