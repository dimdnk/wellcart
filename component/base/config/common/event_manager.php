<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use ConLayout\Block\Factory\BlockFactory;
use WellCart\Base\Service\ConfigurationEditor;
use WellCart\Form\Form;
use WellCart\View\Model\ViewModel;

return
    [
        'event_manager' => [
            'aggregates' => [],
            'listeners'  => [
                EventListener\Config\DoctrineGlobalCacheChanger::class            => [
                    'id'       => ConfigurationEditor::class,
                    'event'    => 'saveConfigSet.pre',
                    'listener' => EventListener\Config\DoctrineGlobalCacheChanger::class,
                    'priority' => -100,
                ],
                EventListener\Config\Mvc\View\NormalizeViewManagerBasePath::class => [
                    'id'       => ConfigurationEditor::class,
                    'event'    => 'saveConfigSet.pre',
                    'listener' => EventListener\Config\Mvc\View\NormalizeViewManagerBasePath::class,
                    'priority' => -100,
                ],
                EventListener\Ui\PrepareLayoutItemView::class                     => [
                    'id'       => BlockFactory::class,
                    'event'    => 'createBlock.post',
                    'listener' => EventListener\Ui\PrepareLayoutItemView::class,
                    'priority' => -100,
                ],
                EventListener\Ui\PrepareFormLayout::class                         => [
                    'id'       => Form::class,
                    'event'    => 'init',
                    'listener' => EventListener\Ui\PrepareFormLayout::class,
                    'priority' => -100,
                ],
                EventListener\Ui\PrepareGridLayout::class                         => [
                    'id'       => ViewModel::class,
                    'event'    => 'configureGrid',
                    'listener' => EventListener\Ui\PrepareGridLayout::class,
                    'priority' => -100,
                ],
            ],
        ],
    ];
