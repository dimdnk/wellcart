<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Login;

use WellCart\User\Spec\UserEntity;
use WellCart\User\Spec\UserRepository;
use Zend\Authentication\Exception\RuntimeException;
use Zend\Authentication\Result;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthenticationAdapterChainEvent;

class EmailNotConfirmed
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
        $code = $e->getCode();
        $email = $e->getRequest()->getPost('identity');

        if ($code !== Result::SUCCESS) {
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
        if (!is_null($user)) {
            if ($user->getEmailConfirmationToken()) {
                $e->stopPropagation();
                $message = __(
                    'This account is not confirmed. Please, check your email.'
                );
                throw new RuntimeException($message);
            }
        }
        return true;
    }
}
