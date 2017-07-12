<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\Catalog\PageView;

$grids = [
    PageView\Backend\AttributesGrid::NAME       => [],
    PageView\Backend\FeaturesGrid::NAME         => [],
    PageView\Backend\BrandsGrid::NAME           => [],
    PageView\Backend\CategoriesGrid::NAME       => [],
    PageView\Backend\ProductsGrid::NAME         => [],
    PageView\Backend\ProductTemplatesGrid::NAME => [],
];
return [
    'ui' => [
        'component' => [
            'gird' => $grids,
        ],
    ],
];
