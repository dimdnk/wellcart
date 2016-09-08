<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Login;

use WellCart\User\Spec\UserEntity;
use WellCart\User\Spec\UserRepository;
use WellCart\Utility\Config;
use Zend\Authentication\Result;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthenticationAdapterChainEvent;

class IdentityReview
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Object constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param AuthenticationAdapterChainEvent $e
     *
     * @return bool
     */
    public function __invoke(AuthenticationAdapterChainEvent $e)
    {
        $maxLoginAttempts = abs(
            (int)Config::get(
                'wellcart.user_account_options.max_login_attempts', 0
            )
        );
        $code = $e->getCode();
        $email = $e->getRequest()->getPost('identity');
        if (!$email || !$maxLoginAttempts
            || in_array(
                $code,
                [
                    Result::FAILURE,
                    Result::FAILURE_IDENTITY_NOT_FOUND,
                    Result::FAILURE_IDENTITY_AMBIGUOUS,
                    Result::FAILURE_UNCATEGORIZED,
                ]
            )
        ) {
            return;
        }

        /**
         * @var $users UserRepository
         */
        $users = $this->userRepository;

        /**
         * @var $user UserEntity
         */
        $user = $users->findOneByEmail($email);
        if (is_null($user)) {
            return;
        }

        switch ($code) {
            case Result::FAILURE_CREDENTIAL_INVALID:
                $user->setFailedLoginCount(
                    $user->getFailedLoginCount() + 1
                );
                break;
            case Result::SUCCESS:
                $user->setPasswordResetToken(null)
                    ->setFailedLoginCount(0);
                break;
        }
        $users->add($user);
        return true;
    }
}
