<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Admin\PageView\Backend\AccountForm;
use WellCart\Admin\PageView\Backend\AccountsGrid;
use WellCart\Admin\Service\Notification;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        'system_config_editor_navigation'                 => 'WellCart\Admin\Factory\Navigation\Service\SystemConfigEditorFactory',
        'WellCart\Admin\Form\Account'                     =>
            function (ContainerInterface $services) {
                $form = new Form\Account(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_user_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\Admin\Repository\Administrators'
                                                          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_admin_object_manager')
                    ->getRepository(
                        'WellCart\Admin\Spec\AdministratorEntity'
                    );
            },
        'WellCart\Admin\Repository\Notifications'
                                                          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_admin_object_manager')
                    ->getRepository(
                        'WellCart\Admin\Spec\NotificationEntity'
                    );
            },
        'WellCart\Admin\Service\Notification'
                                                          =>
            function (ContainerInterface $services) {
                return new Notification(
                    $services->get(
                        'WellCart\Admin\Repository\Notifications'
                    )
                );
            },
        'WellCart\Admin\PageView\Backend\AccountsGrid'      =>
            function (ContainerInterface $services) {
                return new AccountsGrid(
                    $services->get(
                        'WellCart\Admin\Spec\AdministratorRepository'
                    )
                );
            },
        'WellCart\Admin\PageView\Backend\AccountForm'       =>
            function (ContainerInterface $services) {
                return new AccountForm(
                    $services->get(
                        'WellCart\Admin\Spec\AdministratorRepository'
                    )
                );
            },
        'WellCart\Admin\PageView\Backend\NotificationsGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\NotificationsGrid(
                    $services->get(
                        'WellCart\Admin\Spec\NotificationRepository'
                    )
                );
            },

        'WellCart\Admin\Service\RecoverAccount' =>
            function (ContainerInterface $services) {
                $options = $services->get('Config');
                $service = new Service\RecoverAccount(
                    $services->get('log_mail_service_errors'),
                    $services->get('acmailer.mailservice.default'),
                    $services->get('zfcuser_user_service'),
                    $services->get(
                        'WellCart\Admin\Spec\AdministratorRepository'
                    ),
                    $services->get(
                        'WellCart\Admin\Form\RecoverAccount'
                    ),
                    $services->get('zfcuser_change_password_form'),
                    $options['wellcart']['user_account_options']['password_reset']
                );
                return $service;
            },
    ],
];
