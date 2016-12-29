<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Backend\PageView\Backend\AccountForm;
use WellCart\Backend\PageView\Backend\AccountsGrid;
use WellCart\Backend\Service\Notification;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        'system_config_editor_navigation'                 => Factory\Navigation\Service\SystemConfigEditorFactory::class,
        Form\Account::class                     =>
            function (ContainerInterface $services) {
                $form = new Form\Account(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );
                return $form;
            },
        Repository\Administrators::class
                                                          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_admin_object_manager')
                    ->getRepository(
                        Spec\AdministratorEntity::class
                    );
            },
        Repository\Notifications::class
                                                          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_admin_object_manager')
                    ->getRepository(
                        Spec\NotificationEntity::class
                    );
            },
        Service\Notification::class
                                                          =>
            function (ContainerInterface $services) {
                return new Notification(
                    $services->get(
                        Repository\Notifications::class
                    )
                );
            },
        PageView\Backend\AccountsGrid::class      =>
            function (ContainerInterface $services) {
                return new AccountsGrid(
                    $services->get(
                        Spec\AdministratorRepository::class
                    )
                );
            },
        PageView\Backend\AccountForm::class       =>
            function (ContainerInterface $services) {
                return new AccountForm(
                    $services->get(
                        Spec\AdministratorRepository::class
                    )
                );
            },
        PageView\Backend\NotificationsGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\NotificationsGrid(
                    $services->get(
                        Spec\NotificationRepository::class
                    )
                );
            },

        Service\RecoverAccount::class =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $service = new Service\RecoverAccount(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get('zfcuser_user_service'),
                    $services->get(
                        Spec\AdministratorRepository::class
                    ),
                    $services->get(
                        Form\RecoverAccount::class
                    ),
                    $services->get('zfcuser_change_password_form'),
                    $options['wellcart']['user_account_options']['password_reset']
                );
                return $service;
            },
    ],
];
