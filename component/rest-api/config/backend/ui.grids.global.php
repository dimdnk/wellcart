<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\RestApi\PageView;

$grids = [
    PageView\Backend\OAuth2\ClientsGrid::NAME => [],
    PageView\Backend\OAuth2\PublicKeysGrid::NAME => [],
    PageView\Backend\OAuth2\ScopesGrid::NAME => [],
];
return [
    'ui' => [
        'component' => [
            'gird' => $grids,
        ],
    ],
];
