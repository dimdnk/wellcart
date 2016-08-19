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
        'WellCart\User\EventListener\Login\EmailNotConfirmed'                 => [
            'id'       => 'ZfcUser\Authentication\Adapter\AdapterChain',
            'event'    => 'authenticate',
            'listener' => 'WellCart\User\EventListener\Login\EmailNotConfirmed',
            'priority' => -50000,
        ],
        'WellCart\User\EventListener\Login\HandleFailedLoginCount'            => [
            'id'       => 'ZfcUser\Authentication\Adapter\AdapterChain',
            'event'    => 'authenticate',
            'listener' => 'WellCart\User\EventListener\Login\HandleFailedLoginCount',
            'priority' => -50000,
        ],
        'WellCart\User\EventListener\Login\IdentityReview'                    => [
            'id'       => 'ZfcUser\Authentication\Adapter\AdapterChain',
            'event'    => 'authenticate',
            'listener' => 'WellCart\User\EventListener\Login\IdentityReview',
            'priority' => -100000,
        ],
        'WellCart\User\EventListener\Registration\AddRequiredFieldsToForm'    => [
            'id'       => 'ZfcUser\Form\Register',
            'event'    => 'init',
            'listener' => 'WellCart\User\EventListener\Registration\AddRequiredFieldsToForm',
            'priority' => -300,
        ],
        'WellCart\User\EventListener\Registration\AddRequiredFieldsToFilter'  => [
            'id'       => 'ZfcUser\Form\RegisterFilter',
            'event'    => 'init',
            'listener' => 'WellCart\User\EventListener\Registration\AddRequiredFieldsToFilter',
            'priority' => -300,
        ],
        'WellCart\User\EventListener\Registration\SetDefaultAccountSettings'  => [
            'id'       => 'WellCart\User\Service\User',
            'event'    => 'register',
            'listener' => 'WellCart\User\EventListener\Registration\SetDefaultAccountSettings',
            'priority' => -350,
        ],
        'WellCart\User\EventListener\Registration\WelcomeEmail'               => [
            'id'       => 'WellCart\User\Service\User',
            'event'    => 'register',
            'listener' => 'WellCart\User\EventListener\Registration\WelcomeEmail',
            'priority' => -300,
        ],
        'WellCart\User\EventListener\Registration\EmailConfirmation'          => [
            'id'       => 'WellCart\User\Service\User',
            'event'    => 'register',
            'listener' => 'WellCart\User\EventListener\Registration\EmailConfirmation',
            'priority' => -400,
        ],
        'WellCart\User\EventListener\Registration\BindRequiredFieldsToEntity' => [
            'id'       => 'WellCart\User\Service\User',
            'event'    => 'register',
            'listener' => 'WellCart\User\EventListener\Registration\BindRequiredFieldsToEntity',
            'priority' => -500,
        ],
    ],
];
