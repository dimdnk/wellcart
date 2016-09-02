<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

use Interop\Container\ContainerInterface;
use WellCart\User\EventListener\Navigation\PageAuthorizationByRbac;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        'WellCart\User\PageView\Admin\AccountForm'                       =>
            function (ContainerInterface $services) {
                return new PageView\Admin\AccountForm(
                    $services->get('WellCart\User\Spec\UserRepository')
                );
            },
        'WellCart\User\PageView\Admin\AccountsGrid'                      =>
            function (ContainerInterface $services) {
                return new PageView\Admin\AccountsGrid(
                    $services->get('WellCart\User\Spec\UserRepository')
                );
            },
        'WellCart\User\PageView\Admin\RolesGrid'                         =>
            function (ContainerInterface $services) {
                return new PageView\Admin\RolesGrid(
                    $services->get('WellCart\User\Spec\AclRoleRepository')
                );
            },
        'WellCart\User\PageView\Admin\RoleForm'                          =>
            function (ContainerInterface $services) {
                return new PageView\Admin\RoleForm(
                    $services->get('WellCart\User\Spec\AclRoleRepository')
                );
            },
        'WellCart\User\EventListener\Registration\WelcomeEmail'          =>
            function (ContainerInterface $services) {
                return new EventListener\Registration\WelcomeEmail(
                    $services->get(
                        'WellCart\User\Service\Registration\AccountEmailHandler'
                    )
                );
            },
        'WellCart\User\EventListener\Registration\EmailConfirmation'     =>
            function (ContainerInterface $services) {
                return new EventListener\Registration\EmailConfirmation(
                    $services->get(
                        'WellCart\User\Service\Registration\AccountEmailHandler'
                    )
                );
            },
        'WellCart\User\Service\Registration\AccountEmailHandler'         =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $form = new Service\Registration\AccountEmailHandler(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get('WellCart\User\Spec\UserRepository'),
                    $options['wellcart']['user_account_options']['registration']
                );
                return $form;
            },
        'WellCart\User\Service\RecoverAccount'                           =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $service = new Service\RecoverAccount(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get('zfcuser_user_service'),
                    $services->get('WellCart\User\Spec\UserRepository'),
                    $services->get('WellCart\User\Form\RecoverAccount'),
                    $services->get('zfcuser_change_password_form'),
                    $options['wellcart']['user_account_options']['password_reset']
                );
                return $service;
            },
        'WellCart\User\Form\Account'                                     =>
            function (ContainerInterface $services) {
                $form = new Form\Account(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\User\Form\Acl\Role'                                    =>
            function (ContainerInterface $services) {
                $form = new Form\Acl\Role(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\User\Form\AccountPreferences'                          =>
            function (ContainerInterface $services) {
                $form = new Form\AccountPreferences(
                    new FormFactory($services->get('FormElementManager'))
                );
                return $form;
            },
        'WellCart\User\Repository\Users'                                 =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_user_object_manager')
                    ->getRepository(
                        'WellCart\User\Spec\UserEntity'
                    );
            },
        'WellCart\User\Repository\Acl\Roles'                             =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_user_object_manager')
                    ->getRepository(
                        'WellCart\User\Spec\AclRoleEntity'
                    );
            },
        'WellCart\User\Repository\Acl\Permissions'                       =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_user_object_manager')
                    ->getRepository(
                        'WellCart\User\Spec\AclPermissionEntity'
                    );
            },
        'zfcuser_user_mapper'                                            =>
            function (ContainerInterface $services) {
                return new ORM\Mapper\User(
                    $services->get('wellcart_user_object_manager'),
                    $services->get('zfcuser_module_options')
                );
            },

        'Zend\Authentication\AuthenticationService'                      =>
            function (ContainerInterface $serviceManager) {
                $auth = $serviceManager->get(
                    'doctrine.authenticationservice.orm_default'
                );
                return $auth;
            },

        'WellCart\User\EventListener\Navigation\PageAuthorizationByRbac' =>
            function (ContainerInterface $serviceManager) {
                $authorizationService = $serviceManager->get(
                    'ZfcRbac\Service\AuthorizationService'
                );
                return new PageAuthorizationByRbac($authorizationService);
            }
    ],
];
