<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;
use ConLayout\Block\Factory\BlockFactory;
use WellCart\Base\Service\ConfigurationEditor;

return [
    'aggregates' => [],
    'listeners'  => [
        EventListener\DoctrineGlobalCacheChanger::class   => [
            'id'       => ConfigurationEditor::class,
            'event'    => 'saveConfigSet.pre',
            'listener' => EventListener\DoctrineGlobalCacheChanger::class,
            'priority' => -100,
        ],
        EventListener\NormalizeViewManagerBasePath::class => [
            'id'       => ConfigurationEditor::class,
            'event'    => 'saveConfigSet.pre',
            'listener' => EventListener\NormalizeViewManagerBasePath::class,
            'priority' => -100,
        ],
        EventListener\PrepareLayoutItemView::class        => [
            'id'       => BlockFactory::class,
            'event'    => 'createBlock.post',
            'listener' => EventListener\PrepareLayoutItemView::class,
            'priority' => -100,
        ],
    ],
];
