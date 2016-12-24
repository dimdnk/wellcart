<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Backend\Exception\UnprocessableEntityException;
use WellCart\Backend\Spec\AdministratorEntity;
use WellCart\Backend\Spec\AdministratorRepository;
use WellCart\Utility\Arr;
use Zend\Authentication\AuthenticationServiceInterface;

class AdministratorEntityListener
{

    /**
     * @var AuthenticationServiceInterface
     */
    protected $auth;

    /**
     * Object constructor
     *
     * @param AuthenticationServiceInterface $auth
     */
    public function __construct(
        AuthenticationServiceInterface $auth
    ) {
        $this->auth = $auth;
    }


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
        $auth = $this->auth;
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
