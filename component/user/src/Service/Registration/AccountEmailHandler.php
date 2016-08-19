<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Service\Registration;

use AcMailer\Result\MailResult;
use AcMailer\Service\MailServiceAwareInterface;
use AcMailer\Service\MailServiceAwareTrait;
use AcMailer\Service\MailServiceInterface;
use WellCart\User\Repository\Users;
use WellCart\User\Spec\UserEntity;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\Utility\Str;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Log\LoggerAwareTrait;
use Zend\Log\LoggerInterface;

class AccountEmailHandler
    implements EventManagerAwareInterface, MailServiceAwareInterface
{

    use EventManagerAwareTrait;

    use MailServiceAwareTrait;

    use LoggerAwareTrait;

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
            'send_welcome_email' => true,
            'confirm_email'      => true,
            'email_contact'      => 'general',
            'email_template'     => [
                'welcome'            => 'wellcart-user/welcome',
                'email_confirmation' => 'wellcart-user/email_confirmation',
                'email_confirmed'    => 'wellcart-user/email_confirmed',
            ],
        ];

    /**
     * Object constructor
     *
     * @param LoggerInterface      $logger
     * @param MailServiceInterface $mailer
     * @param Users                $users
     * @param array                $options
     */
    public function __construct(
        LoggerInterface $logger,
        MailServiceInterface $mailer,
        Users $users,
        array $options = []
    ) {
        $this->setLogger($logger);
        $this->setMailService($mailer);
        $this->repository = $users;
        $this->options = Arr::merge($this->options, $options);

        $events = $this->getEventManager();
        $events->trigger('init', $this);
    }

    /**
     * Send welcome email to user?
     *
     * @return bool
     */
    public function isSendWelcomeEmail(): bool
    {
        return (
            ($this->isEnabled()) && !($this->isConfirmEmail())
            && ($this->options['send_welcome_email'])
        );
    }

    /**
     * Determine is mailing possible
     *
     * @return bool
     */
    protected function isEnabled()
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
            'acmailer_options.communications.enabled',
            true
        );
    }

    /**
     * Email contact
     *
     * @return array|bool
     */
    protected function getEmailContact()
    {
        return Config::get(
            'acmailer_options.contacts.' . $this->options['email_contact'],
            false
        );
    }

    /**
     * Confirm user email address?
     *
     * @return bool
     */
    public function isConfirmEmail(): bool
    {
        return (
            ($this->isEnabled()) && ($this->options['confirm_email'])
        );
    }

    /**
     * Send welcome email
     *
     * @param UserEntity $user
     *
     * @return \AcMailer\Result\ResultInterface
     */
    public function sendWelcomeEmail(
        UserEntity $user
    ) {
        $mailSubject = sprintf(
            __('Welcome to %s'),
            Config::get('website.name', 'Demo Application')
        );

        return $this->send(
            __FUNCTION__,
            'welcome',
            $mailSubject,
            $user
        );
    }

    /**
     * Send email
     *
     * @param  string     $eventId
     * @param  string     $template
     * @param  string     $mailSubject
     * @param UserEntity  $user
     * @param null|string $url
     *
     * @return MailResult
     */
    protected function send(
        $eventId,
        $template,
        $mailSubject,
        UserEntity $user,
        $url = null
    ) {
        $mailer = $this->getMailService();
        $emailContact = $this->getEmailContact();
        $template = $this->getMailTemplate($template);

        $message = $mailer->getMessage();
        $message->setSubject($mailSubject)
            ->setFrom($emailContact['email'], $emailContact['name'])
            ->addTo($user->getEmail(), $user->getDisplayName());

        $params = compact(
            'user',
            'mailer',
            'message',
            'emailContact',
            'mailSubject',
            'template',
            'url'
        );

        $mailer->setTemplate($template, $params);
        $this->getEventManager()->trigger(
            $eventId . '.pre',
            $this,
            $params
        );

        /**
         * @var $result MailResult
         */
        $result = $mailer->send();

        $params['result'] = $result;
        $this->getEventManager()->trigger(
            $eventId . '.post',
            $this,
            $params
        );

        if (!$result->isValid()) {
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
            $user->setEmailConfirmationToken(null);
            $this->getLogger()->err($msg);
        }
        $this->getRepository()->add($user);
        return $result;
    }

    /**
     * Email template
     *
     * @param string $type
     *
     * @return string
     */
    protected function getMailTemplate($type)
    {
        return 'mail/' . $this->options['email_template'][(string)$type];
    }

    /**
     * @return Users
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Confirm email
     *
     * @param UserEntity $user
     *
     * @return bool
     */
    public function confirmEmail(UserEntity $user)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('user')
        );

        $user->setEmailConfirmationToken(null);
        $this->getRepository()->add($user);

        $mailSubject = sprintf(
            __('Welcome to %s'),
            Config::get('website.name', 'Demo Application')
        );

        return $this->send(
            __FUNCTION__,
            'email_confirmed',
            $mailSubject,
            $user
        );
    }

    /**
     * Send email with link for address confirmation
     *
     * @param UserEntity $user
     *
     * @return \AcMailer\Result\ResultInterface
     */
    public function sendConfirmationEmail(UserEntity $user)
    {
        $token = $this->generateToken();
        $user->setEmailConfirmationToken($token);
        $url = url_to_route('user-account-confirm-email', ['token' => $token]);

        $mailSubject = sprintf(
            __('Please confirm your %s account'),
            Config::get('website.name', 'Demo Application')
        );

        return $this->send(
            __FUNCTION__,
            'email_confirmation',
            $mailSubject,
            $user,
            $url
        );
    }

    /**
     * Generate unique token
     *
     * @return string
     */
    protected function generateToken()
    {
        return md5(uniqid(microtime() . Str::random(Str::NUMERIC), true));
    }

    /**
     * Is valid token
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

        return $this->repository->isEmailConfirmationTokenExists($token);
    }
}
