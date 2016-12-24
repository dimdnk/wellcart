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
        'system_config_editor_navigation'                 => 'WellCart\Backend\Factory\Navigation\Service\SystemConfigEditorFactory',
        'WellCart\Backend\Form\Account'                     =>
            function (ContainerInterface $services) {
                $form = new Form\Account(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\Backend\Repository\Administrators'
                                                          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_admin_object_manager')
                    ->getRepository(
                        'WellCart\Backend\Spec\AdministratorEntity'
                    );
            },
        'WellCart\Backend\Repository\Notifications'
                                                          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_admin_object_manager')
                    ->getRepository(
                        'WellCart\Backend\Spec\NotificationEntity'
                    );
            },
        'WellCart\Backend\Service\Notification'
                                                          =>
            function (ContainerInterface $services) {
                return new Notification(
                    $services->get(
                        'WellCart\Backend\Repository\Notifications'
                    )
                );
            },
        'WellCart\Backend\PageView\Backend\AccountsGrid'      =>
            function (ContainerInterface $services) {
                return new AccountsGrid(
                    $services->get(
                        'WellCart\Backend\Spec\AdministratorRepository'
                    )
                );
            },
        'WellCart\Backend\PageView\Backend\AccountForm'       =>
            function (ContainerInterface $services) {
                return new AccountForm(
                    $services->get(
                        'WellCart\Backend\Spec\AdministratorRepository'
                    )
                );
            },
        'WellCart\Backend\PageView\Backend\NotificationsGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\NotificationsGrid(
                    $services->get(
                        'WellCart\Backend\Spec\NotificationRepository'
                    )
                );
            },

        'WellCart\Backend\Service\RecoverAccount' =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $service = new Service\RecoverAccount(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get('zfcuser_user_service'),
                    $services->get(
                        'WellCart\Backend\Spec\AdministratorRepository'
                    ),
                    $services->get(
                        'WellCart\Backend\Form\RecoverAccount'
                    ),
                    $services->get('zfcuser_change_password_form'),
                    $options['wellcart']['user_account_options']['password_reset']
                );
                return $service;
            },
    ],
];
