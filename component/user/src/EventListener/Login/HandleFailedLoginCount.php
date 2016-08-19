<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Login;

use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use WellCart\User\Spec\UserRepository;
use WellCart\Utility\Config;
use Zend\Authentication\Exception\RuntimeException;
use Zend\Authentication\Result;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthenticationAdapterChainEvent;

class HandleFailedLoginCount implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

    /**
     * @param AuthenticationAdapterChainEvent $e
     *
     * @return bool
     */
    public function __invoke(AuthenticationAdapterChainEvent $e)
    {
        $maxLoginAttempts = abs(
            (int)Config::get('user_account_options.max_login_attempts', 0)
        );

        $code = $e->getCode();
        $email = $e->getRequest()->getPost('identity');

        if (!$email || !$maxLoginAttempts
            || $code !== Result::FAILURE_CREDENTIAL_INVALID
        ) {
            return;
        }

        /**
         * @var $users UserRepository
         */
        $users = $this->getServiceLocator()->get(
            'WellCart\User\Spec\UserRepository'
        );

        /**
         * @var $user \WellCart\User\Spec\UserEntity
         */
        $user = $users->findOneByEmail($email);
        if (!is_null($user)) {
            $failedLoginCount = $user->getFailedLoginCount();
            if ($failedLoginCount >= $maxLoginAttempts) {
                $e->stopPropagation();
                $msg = __(
                    'You exceeded the maximum allowed number of login attempt.'
                );
                throw new RuntimeException($msg);
            }
        }

        return true;
    }
}
