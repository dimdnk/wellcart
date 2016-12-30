<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

use ZfcUser\Authentication\Adapter\AdapterChain as AuthAdapterChain;

return [
    'event_manager' => [
        'aggregates' => [],
        'listeners'  => [
            EventListener\Login\EmailNotConfirmed::class                 => [
                'id'       => AuthAdapterChain::class,
                'event'    => 'authenticate',
                'listener' => EventListener\Login\EmailNotConfirmed::class,
                'priority' => -50000,
            ],
            EventListener\Login\HandleFailedLoginCount::class            => [
                'id'       => AuthAdapterChain::class,
                'event'    => 'authenticate',
                'listener' => EventListener\Login\HandleFailedLoginCount::class,
                'priority' => -50000,
            ],
            EventListener\Login\IdentityReview::class                    => [
                'id'       => AuthAdapterChain::class,
                'event'    => 'authenticate',
                'listener' => EventListener\Login\IdentityReview::class,
                'priority' => -100000,
            ],
            EventListener\Registration\AddRequiredFieldsToForm::class    => [
                'id'       => 'ZfcUser\Form\Register',
                'event'    => 'init',
                'listener' => EventListener\Registration\AddRequiredFieldsToForm::class,
                'priority' => -300,
            ],
            EventListener\Registration\AddRequiredFieldsToFilter::class  => [
                'id'       => 'ZfcUser\Form\RegisterFilter',
                'event'    => 'init',
                'listener' => EventListener\Registration\AddRequiredFieldsToFilter::class,
                'priority' => -300,
            ],
            EventListener\Registration\SetDefaultAccountSettings::class  => [
                'id'       => Service\User::class,
                'event'    => 'register',
                'listener' => EventListener\Registration\SetDefaultAccountSettings::class,
                'priority' => -350,
            ],
            EventListener\Registration\WelcomeEmail::class               => [
                'id'       => Service\User::class,
                'event'    => 'register',
                'listener' => EventListener\Registration\WelcomeEmail::class,
                'priority' => -300,
            ],
            EventListener\Registration\EmailConfirmation::class          => [
                'id'       => Service\User::class,
                'event'    => 'register',
                'listener' => EventListener\Registration\EmailConfirmation::class,
                'priority' => -400,
            ],
            EventListener\Registration\BindRequiredFieldsToEntity::class => [
                'id'       => Service\User::class,
                'event'    => 'register',
                'listener' => EventListener\Registration\BindRequiredFieldsToEntity::class,
                'priority' => -500,
            ],
        ],
    ],
];
