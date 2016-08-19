<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'aggregates' => [],
    'listeners'  => [
        'WellCart\Base\EventListener\DoctrineGlobalCacheChanger'   => [
            'id'       => 'WellCart\Base\Service\ConfigurationEditor',
            'event'    => 'saveConfigSet.pre',
            'listener' => 'WellCart\Base\EventListener\DoctrineGlobalCacheChanger',
            'priority' => -100,
        ],
        'WellCart\Base\EventListener\NormalizeViewManagerBasePath' => [
            'id'       => 'WellCart\Base\Service\ConfigurationEditor',
            'event'    => 'saveConfigSet.pre',
            'listener' => 'WellCart\Base\EventListener\NormalizeViewManagerBasePath',
            'priority' => -100,
        ],
        'WellCart\Base\EventListener\PrepareLayoutItemView'        => [
            'id'       => 'ConLayout\Block\Factory\BlockFactory',
            'event'    => 'createBlock.post',
            'listener' => 'WellCart\Base\EventListener\PrepareLayoutItemView',
            'priority' => -100,
        ],
    ],
];
