<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

use Interop\Container\ContainerInterface;
use WellCart\User\EventListener\Navigation\PageAuthorizationByRbac;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        PageView\Backend\AccountForm::class                 =>
            function (ContainerInterface $services) {
                return new PageView\Backend\AccountForm(
                    $services->get(Spec\UserRepository::class)
                );
            },
        PageView\Backend\AccountsGrid::class                =>
            function (ContainerInterface $services) {
                return new PageView\Backend\AccountsGrid(
                    $services->get(Spec\UserRepository::class)
                );
            },
        PageView\Backend\RolesGrid::class                   =>
            function (ContainerInterface $services) {
                return new PageView\Backend\RolesGrid(
                    $services->get(Spec\AclRoleRepository::class)
                );
            },
        PageView\Backend\RoleForm::class                    =>
            function (ContainerInterface $services) {
                return new PageView\Backend\RoleForm(
                    $services->get(Spec\AclRoleRepository::class)
                );
            },
        EventListener\Registration\WelcomeEmail::class      =>
            function (ContainerInterface $services) {
                return new EventListener\Registration\WelcomeEmail(
                    $services->get(
                        Service\Registration\AccountEmailHandler::class
                    )
                );
            },
        EventListener\Registration\EmailConfirmation::class =>
            function (ContainerInterface $services) {
                return new EventListener\Registration\EmailConfirmation(
                    $services->get(
                        Service\Registration\AccountEmailHandler::class
                    )
                );
            },
        Service\Registration\AccountEmailHandler::class     =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $form = new Service\Registration\AccountEmailHandler(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get(Spec\UserRepository::class),
                    $options['wellcart']['user_account_options']['registration']
                );

                return $form;
            },
        Service\RecoverAccount::class                       =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $service = new Service\RecoverAccount(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get('zfcuser_user_service'),
                    $services->get(Spec\UserRepository::class),
                    $services->get(Form\RecoverAccount::class),
                    $services->get('zfcuser_change_password_form'),
                    $options['wellcart']['user_account_options']['password_reset']
                );

                return $service;
            },
        Form\Account::class                                 =>
            function (ContainerInterface $services) {
                $form = new Form\Account(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );

                return $form;
            },
        Form\Acl\Role::class                                =>
            function (ContainerInterface $services) {
                $form = new Form\Acl\Role(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );

                return $form;
            },
        Form\AccountPreferences::class                      =>
            function (ContainerInterface $services) {
                $form = new Form\AccountPreferences(
                    new FormFactory($services->get('FormElementManager'))
                );

                return $form;
            },
        Repository\Users::class                             =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_user_object_manager')
                    ->getRepository(
                        Spec\UserEntity::class
                    );
            },
        Repository\Acl\Roles::class                         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_user_object_manager')
                    ->getRepository(
                        Spec\AclRoleEntity::class
                    );
            },
        Repository\Acl\Permissions::class                   =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_user_object_manager')
                    ->getRepository(
                        Spec\AclPermissionEntity::class
                    );
            },
        'zfcuser_user_mapper'                               =>
            function (ContainerInterface $services) {
                return new ORM\Mapper\User(
                    $services->get('wellcart_user_object_manager'),
                    $services->get('zfcuser_module_options')
                );
            },

        'Zend\Authentication\AuthenticationService' =>
            function (ContainerInterface $serviceManager) {
                $auth = $serviceManager->get(
                    'doctrine.authenticationservice.orm_default'
                );

                return $auth;
            },

        EventListener\Navigation\PageAuthorizationByRbac::class =>
            function (ContainerInterface $serviceManager) {
                $authorizationService = $serviceManager->get(
                    'ZfcRbac\Service\AuthorizationService'
                );

                return new PageAuthorizationByRbac($authorizationService);
            },
    ],
];
