<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\Directory\PageView;

$grids = [
    PageView\Backend\CountriesGrid::NAME  => [],
    PageView\Backend\CurrenciesGrid::NAME => [],
    PageView\Backend\GeoZonesGrid::NAME   => [],
    PageView\Backend\ZonesGrid::NAME      => [],
];
return [
    'ui' => [
        'component' => [
            'gird' => $grids,
        ],
    ],
];
