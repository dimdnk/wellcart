<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\CommandBus;
use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext as FinishesHandlingMessage;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use WellCart\CommandBus\Command\PersistEntity;
use WellCart\CommandBus\CommandHandler\ClosureHandler;
use WellCart\CommandBus\CommandHandler\PersistEntityHandler;
use WellCart\CommandBus\Middleware\DoctrineWrapsMessageHandlingInTransaction as WrapsMessageHandlingInTransaction;

return [
    'service_manager'    => [
        'invokables' => [
            'command_bus.finishes_command_before_handling_next_middleware' => 'SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext',
            'command_bus.class_based_command_name_resolver'                => 'SimpleBus\Message\Name\ClassBasedNameResolver',
            'command_bus.named_message_command_name_resolver'              => 'SimpleBus\Message\Name\NamedMessageNameResolver',
            ClosureHandler::class                                          => ClosureHandler::class,
            PersistEntityHandler::class                                    => PersistEntityHandler::class,
            FinishesHandlingMessage::class                                 => FinishesHandlingMessage::class,
            ClassBasedNameResolver::class                                  => ClassBasedNameResolver::class,
        ],
        'factories'  => [
            'command_bus'                          => Factory\CommandBusFactory::class,
            'command_bus.config'                   => Factory\CommandBusConfigFactory::class,
            'command_bus.callable_resolver'        => Factory\CallableResolverFactory::class,
            'command_bus.command_handler_map'      => Factory\CommandHandlerMapFactory::class,
            'command_bus.command_handler_resolver' => Factory\CommandHandlerResolverFactory::class,
            'command_bus.logging_middleware'       => Factory\LoggingMiddlewareFactory::class,

            DelegatesToMessageHandlerMiddleware::class => Factory\DelegatesToMessageHandlerMiddlewareFactory::class,
            WrapsMessageHandlingInTransaction::class   => Factory\DoctrineWrapsMessageHandlingInTransactionFactory::class,
        ],
        'aliases'    => [
            'command_bus.doctrine.wraps_message_handling_in_transaction_middleware' => WrapsMessageHandlingInTransaction::class,
            'command_bus.delegates_to_message_handler_middleware'                   => DelegatesToMessageHandlerMiddleware::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'command_bus' => Factory\Mvc\CommandBusControllerPluginFactory::class,
        ],
    ],

    'command_bus' => [
        'command_name_resolver_strategy' => ClassBasedNameResolver::class,
        'middlewares'                    => [
            FinishesHandlingMessage::class             => [
                'priority' => 90000,
            ],
            DelegatesToMessageHandlerMiddleware::class => [
                'priority' => 90000,
            ],
            WrapsMessageHandlingInTransaction::class   => [
                'priority' => -90000,
            ],
        ],
        'command_map'                    => [
            \Closure::class       => ClosureHandler::class,
            PersistEntity::class => PersistEntityHandler::class,
        ],
    ],
];
