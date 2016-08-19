<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Command\Handler;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use WellCart\User\Command\PersistUserAccount;
use WellCart\Utility\Arr;
use WellCart\Utility\Str;

class PersistUserAccountHandler
    implements ObjectManagerAwareInterface, ServiceLocatorAwareInterface
{
    use ProvidesObjectManager, ServiceLocatorAwareTrait;

    /**
     * @param PersistUserAccount $command
     *
     * @return \WellCart\User\Spec\UserEntity
     */
    public function handle(PersistUserAccount $command)
    {
        $user = $command->getUser();
        $data = $command->getData();
        $userService = $this->getServiceLocator()
            ->get('zfcuser_user_service');
        $userService->getUserMapper()->setUserEntityClass(
            get_class($user)
        );

        if ($user->getId()) {
            if ($password = Arr::get($data, 'password')) {
                $passwordVerify = Arr::get($data, 'passwordVerify');
                if ((strlen($password) < 6) || ($password != $passwordVerify)) {
                    throw new \DomainException(
                        __(
                            'Please enter 6 or more characters for password. Repeat to confirm. Leading or trailing spaces will be ignored. '
                        )
                    );
                }
                $userService->updatePassword($user, $password);
            } else {
                $this->getObjectManager()->persist($user);
            }
            return $user;
        } else {
            $result = $userService->register($data);
            if (!$result) {
                $messages = $userService->getRegisterForm()
                    ->getMessages();
                $er = '';
                foreach ($messages as $field => $errors) {
                    $field = Str::title(Str::camel2underscored($field));
                    $er .= sprintf('%s: %s, ', $field, current($errors));
                }
                $er = trim($er, ', ');
                throw new \DomainException(
                    sprintf(
                        'Admin user registration failed. %s',
                        $er
                    )
                );
            }
            $command->setUser($result);
        }
    }
}
