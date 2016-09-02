<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Service;

use AcMailer\Result\MailResult;
use AcMailer\Service\MailServiceAwareInterface;
use AcMailer\Service\MailServiceAwareTrait;
use AcMailer\Service\MailServiceInterface;
use WellCart\User\Exception\DomainException;
use WellCart\User\Form\RecoverAccount as RecoverAccountForm;
use WellCart\User\Service\User as UserService;
use WellCart\User\Spec\UserEntity;
use WellCart\User\Spec\UserRepository as Users;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\Utility\Str;
use WellCart\Utility\Time;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Log\LoggerAwareTrait;
use Zend\Log\LoggerInterface;
use ZfcUser\Form\ChangePassword;

class RecoverAccount
    implements EventManagerAwareInterface, MailServiceAwareInterface
{

    use EventManagerAwareTrait;

    use MailServiceAwareTrait;

    use LoggerAwareTrait;

    /**
     * @var RecoverAccountForm
     */
    protected $recoverAccountForm;

    /**
     * @var ChangePassword
     */
    protected $changePasswordForm;

    /**
     * @var Users
     */
    protected $repository;

    /**
     * @var \WellCart\User\Service\User
     */
    protected $userService;

    /**
     * @var array
     */
    protected $options
        = [
            'email_contact'          => 'support',
            'email_template'         => 'wellcart-user/password_reset',
            'link_expiration_period' => 1,
        ];

    /**
     * Object constructor
     *
     * @param LoggerInterface      $logger
     * @param MailServiceInterface $mailer
     * @param UserService          $userService
     * @param Users                $administrators
     * @param RecoverAccountForm   $recoverForm
     * @param ChangePassword       $changePasswordForm
     * @param array                $options
     */
    public function __construct(
        LoggerInterface $logger,
        MailServiceInterface $mailer,
        UserService $userService,
        Users $administrators,
        RecoverAccountForm $recoverForm,
        ChangePassword $changePasswordForm,
        array $options = []
    ) {
        $this->setLogger($logger);
        $this->setMailService($mailer);
        $this->userService = $userService;
        $this->repository = $administrators;
        $this->recoverAccountForm = $recoverForm;
        $this->changePasswordForm = $changePasswordForm;
        $this->options = Arr::merge($this->options, $options);

        $events = $this->getEventManager();

        $events->attach(
            'initiate.pre',
            function () {
                $this->cleanExpiredTokens();
            }
        );
        $events->trigger('init', $this);
    }

    /**
     * Clean expired tokens
     *
     * @return mixed
     */
    public function cleanExpiredTokens()
    {
        $expirySeconds = max(
                1,
                abs(
                    (int)Config::get(
                        'wellcart.user_account_options.password_reset.link_expiration_period',
                        1
                    )
                )
            ) * Time::DAY;
        return $this->repository->cleanExpiredPasswordResetTokens(
            $expirySeconds
        );
    }

    /**
     * @return ChangePassword
     */
    public function getChangePasswordForm()
    {
        return $this->changePasswordForm;
    }

    /**
     * Change reset password link token for the user. Stores new reset password
     *
     * @param string $email
     * @param string $route
     */
    public function initiate($email, $route)
    {
        /**
         * @var $user UserEntity
         */
        $user = $this->repository->findOneByEmail($email);
        $token = $this->generateToken();

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('user', 'token')
        );
        $exception = null;

        try {
            $user->setPasswordResetToken($token);
            $this->sendConfirmationEmail($user, $route);
        } catch (\Throwable $exception) {
            $user->setPasswordResetToken(null);
            $this->getLogger()->err($exception->__toString());
            $this->getEventManager()->trigger(
                __FUNCTION__ . '.exception',
                $this,
                compact('user', 'token', 'exception')
            );
        }
        $this->repository->add($user);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('user', 'token')
        );

        if ($exception) {
            throw new $exception($exception->getMessage());
        }
    }

    /**
     * Generate unique token for reset password confirmation link
     *
     * @return string
     */
    protected function generateToken()
    {
        return md5(uniqid(microtime() . Str::random(Str::NUMERIC), true));
    }

    /**
     * Send email with reset password confirmation link
     *
     * @param UserEntity $user
     * @param string     $route
     *
     * @return \AcMailer\Result\ResultInterface
     */
    protected function sendConfirmationEmail(UserEntity $user, $route)
    {
        $mailer = $this->getMailService();
        $emailContact = $this->getEmailContact();
        $template = $this->getMailTemplate();
        $token = $user->getPasswordResetToken();
        $url = url_to_route($route, ['token' => $token]);

        $mailSubject = sprintf(
            __('[%s] Password Reset Confirmation for %s'),
            Config::get('wellcart.website.name', 'Demo Application'),
            $user->getDisplayName()
        );

        $message = $mailer->getMessage();
        $message->setSubject($mailSubject)
            ->setFrom($emailContact['email'], $emailContact['name'])
            ->addTo($user->getEmail(), $user->getDisplayName());

        $params = compact(
            'user',
            'token',
            'url',
            'mailer',
            'message',
            'emailContact',
            'mailSubject',
            'template'
        );

        $mailer->setTemplate($template, $params);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            $params
        );

        $result = $mailer->send();

        $params['result'] = $result;
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            $params
        );

        if (!$result->isValid()) {
            /**
             * @var $result MailResult
             */
            if ($result->hasException()) {
                $msg = sprintf(
                    'An error occurred. Exception: \n %s',
                    $result->getException()->getTraceAsString()
                );
            } else {
                $msg = sprintf(
                    'An error occurred. Message: %s',
                    $result->getMessage()
                );
            }
            $this->getLogger()->err($msg);
            throw new DomainException($msg);
        }

        return $result;
    }

    /**
     * Email contact
     *
     * @return array|bool
     */
    protected function getEmailContact()
    {
        return Config::get(
            'wellcart.email_communications.contacts.'
            . $this->options['email_contact'],
            false
        );
    }

    /**
     * Email template
     *
     * @return array|bool
     */
    protected function getMailTemplate()
    {
        return 'mail/' . $this->options['email_template'];
    }

    /**
     * @return Users
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Determine is recover possible
     *
     * @return bool
     */
    public function isRecoverPossible(): bool
    {
        return (
            $this->isEmailCommunicationsEnabled() && $this->getEmailContact()
        );
    }

    /**
     * Determine email communications state
     *
     * @return bool
     */
    protected function isEmailCommunicationsEnabled()
    {
        return (bool)Config::get(
            'wellcart.email_communications.enabled',
            true
        );
    }

    /**
     * @return RecoverAccountForm
     */
    public function getRecoverAccountForm()
    {
        return $this->recoverAccountForm;
    }

    /**
     * Is valid reset password token
     *
     * @param $token
     *
     * @return bool
     */
    public function isValidToken($token): bool
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('token')
        );

        return $this->repository->isPasswordTokenExists($token);
    }

    /**
     * Update user password
     *
     * @param UserEntity          $user
     * @param                     $password
     *
     * @return bool
     */
    public function resetPassword(UserEntity $user, $password)
    {
        $user->setPasswordResetToken(null);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('user', 'password')
        );

        $result = $this->userService->updatePassword($user, $password);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('user', 'password', 'result')
        );
        return $result;
    }
}
