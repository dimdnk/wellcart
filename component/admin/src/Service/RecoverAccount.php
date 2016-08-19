<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Service;

use AcMailer\Service\MailServiceInterface;
use WellCart\Admin\Form\RecoverAccount as RecoverAccountForm;
use WellCart\Admin\Spec\AdministratorRepository as Administrators;
use WellCart\User\Service\RecoverAccount as RecoverUserAccount;
use WellCart\User\Service\User as UserService;
use Zend\Log\LoggerInterface;
use ZfcUser\Form\ChangePassword;

class RecoverAccount extends RecoverUserAccount
{

    /**
     * Object constructor
     *
     * @param LoggerInterface      $logger
     * @param MailServiceInterface $mailer
     * @param UserService          $userService
     * @param Administrators       $administrators
     * @param RecoverAccountForm   $recoverForm
     * @param ChangePassword       $changePasswordForm
     * @param array                $options
     */
    public function __construct(
        LoggerInterface $logger,
        MailServiceInterface $mailer,
        UserService $userService,
        Administrators $administrators,
        RecoverAccountForm $recoverForm,
        ChangePassword $changePasswordForm,
        array $options = []
    ) {
        parent::__construct(
            $logger,
            $mailer,
            $userService,
            $administrators,
            $recoverForm,
            $changePasswordForm,
            $options
        );
    }
}
