<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Admin\Exception\UnprocessableEntityException;
use WellCart\Admin\Spec\AdministratorEntity;
use WellCart\Admin\Spec\AdministratorRepository;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use WellCart\Utility\Arr;

class AdministratorEntityListener implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

    /**
     * @param AdministratorEntity $user
     * @param LifecycleEventArgs  $args
     */
    public function preUpdate(
        AdministratorEntity $user,
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

    /**
     * @param AdministratorEntity $user
     * @param LifecycleEventArgs  $args
     */
    public function postUpdate(
        AdministratorEntity $user,
        LifecycleEventArgs $args
    ) {
        if (!$user->hasRole('superadmin')) {
            /**
             * @var $repository AdministratorRepository
             */
            $repository = $args->getObjectManager()
                ->getRepository(AdministratorEntity::class);
            $userIds = $repository->getUserIdsWithRole('superadmin');
            $result = array_diff($userIds, [$user->getId()]);
            if (empty($result)) {
                throw new UnprocessableEntityException(
                    'At least one user must be assigned the superadmin role.'
                );
            }
        }
    }

    public function preRemove(AdministratorEntity $user)
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
