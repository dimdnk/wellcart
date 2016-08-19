<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use WellCart\User\Exception\UnprocessableEntityException;
use WellCart\User\Spec\UserEntity;
use WellCart\Utility\Arr;

class UserEntityListener implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

    public function preUpdate(
        UserEntity $user,
        LifecycleEventArgs $args
    ) {
        $changeSet = $args->getObjectManager()
            ->getUnitOfWork()
            ->getEntityChangeSet($user);
        $oldPassword = Arr::get($changeSet, 'password.0');
        $newPassword = Arr::get($changeSet, 'password.1');
        if (!empty($oldPassword) && empty($newPassword)) {
            throw new UnprocessableEntityException(
                'Account password is required & cannot by empty.'
            );
        }
    }

    public function preRemove(UserEntity $user)
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        if ($auth->hasIdentity()
            && $auth->getIdentity()
                ->getId() == $user->getId()
        ) {
            throw new UnprocessableEntityException(
                'Unable to remove user: user is currently logged in'
            );
        }
    }
}
