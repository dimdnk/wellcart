<?php

use WellCart\Ui\Layout\Block\BlockPool;
use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\Block\Factory\BlockFactoryFactory;
use WellCart\Ui\Layout\Block\Factory\BlockFactoryInterface;
use WellCart\Ui\Layout\BlockManager;
use WellCart\Ui\Layout\BlockManagerFactory;
use WellCart\Ui\Layout\Generator\BlocksGenerator;
use WellCart\Ui\Layout\Generator\BlocksGeneratorFactory;
use WellCart\Ui\Layout\Generator\ViewHelperGenerator;
use WellCart\Ui\Layout\Generator\ViewHelperGeneratorFactory;
use WellCart\Ui\Layout\Layout\LayoutFactory;
use WellCart\Ui\Layout\Layout\LayoutInterface;
use WellCart\Ui\Layout\Listener\ActionHandlesListener;
use WellCart\Ui\Layout\Listener\BodyClassListener;
use WellCart\Ui\Layout\Listener\Factory\ActionHandlesListenerFactory;
use WellCart\Ui\Layout\Listener\Factory\BodyClassListenerFactory;
use WellCart\Ui\Layout\Listener\Factory\LayoutTemplateListenerFactory;
use WellCart\Ui\Layout\Listener\Factory\LayoutUpdateListenerFactory;
use WellCart\Ui\Layout\Listener\Factory\LoadLayoutListenerFactory;
use WellCart\Ui\Layout\Listener\Factory\ViewHelperListenerFactory;
use WellCart\Ui\Layout\Listener\LayoutTemplateListener;
use WellCart\Ui\Layout\Listener\LayoutUpdateListener;
use WellCart\Ui\Layout\Listener\LoadLayoutListener;
use WellCart\Ui\Layout\Listener\PrepareActionViewModelListener;
use WellCart\Ui\Layout\Listener\ViewHelperListener;
use WellCart\Ui\Layout\Options\ModuleOptions;
use WellCart\Ui\Layout\Options\ModuleOptionsFactory;
use WellCart\Ui\Layout\Updater\LayoutUpdaterFactory;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use WellCart\Ui\Layout\Zdt\Collector\LayoutCollector;
use WellCart\Ui\Layout\Zdt\Collector\LayoutCollectorFactory;
use WellCart\Ui\Layout\Listener\Factory\PrepareActionViewModelListenerFactory;
use WellCart\Ui\Layout\Updater\Collector\FilesystemCollector;
use WellCart\Ui\Layout\Updater\Collector\FilesystemCollectorFactory;
use WellCart\Ui\Layout\Updater\Collector\ConfigCollector;
use WellCart\Ui\Layout\Updater\Collector\ConfigCollectorFactory;

return [
    'factories' => [
        FilesystemCollector::class      => FilesystemCollectorFactory::class,
        ConfigCollector::class          => ConfigCollectorFactory::class,
        BlockManager::class             => BlockManagerFactory::class,
        BlockFactoryInterface::class    => BlockFactoryFactory::class,
        ActionHandlesListener::class    => ActionHandlesListenerFactory::class,
        BodyClassListener::class        => BodyClassListenerFactory::class,
        LoadLayoutListener::class       => LoadLayoutListenerFactory::class,
        PrepareActionViewModelListener::class => PrepareActionViewModelListenerFactory::class,
        LayoutInterface::class          => LayoutFactory::class,
        LayoutUpdaterInterface::class   => LayoutUpdaterFactory::class,
        LayoutCollector::class          => LayoutCollectorFactory::class,
        ModuleOptions::class            => ModuleOptionsFactory::class,
        BlocksGenerator::class          => BlocksGeneratorFactory::class,
        ViewHelperGenerator::class      => ViewHelperGeneratorFactory::class
    ],
    'aliases' => [
        'Layout'                => LayoutInterface::class,
        'BlockManager'          => BlockManager::class
    ],
    'invokables' => [
        BlockPoolInterface::class => BlockPool::class,
    ]
];
