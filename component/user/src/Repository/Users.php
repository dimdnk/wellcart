<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Repository;

use WellCart\ORM\AbstractRepository;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\UserEntity;
use WellCart\User\Spec\UserRepository;

class Users extends AbstractRepository implements UserRepository
{

    /**
     * Find user by email
     *
     * @param $email
     *
     * @return null|UserEntity
     */
    public function findOneByEmail($email)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('email')
        );
        $user = $this->findOneBy(['email' => (string)$email]);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('email', 'user')
        );
        return $user;
    }

    /**
     * Find user by password reset token
     *
     * @param $token
     *
     * @return null|UserEntity
     */
    public function findOneByPasswordResetToken($token)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('token')
        );
        $user = $this->findOneBy(['passwordResetToken' => (string)$token]);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('token', 'user')
        );
        return $user;
    }

    /**
     * Find user by email confirmation token
     *
     * @param $token
     *
     * @return null|UserEntity
     */
    public function findOneByEmailConfirmationToken($token)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('token')
        );
        $user = $this->findOneBy(['emailConfirmationToken' => (string)$token]);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('token', 'user')
        );
        return $user;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function isPasswordTokenExists($token): bool
    {
        return (bool)$this->finder()
            ->countObjectsWithValue('passwordResetToken', $token);
    }

    /**
     * @return UsersQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('UserEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return UsersQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new UsersQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function isEmailConfirmationTokenExists($token): bool
    {
        return (bool)$this->finder()
            ->countObjectsWithValue('emailConfirmationToken', $token);
    }

    /**
     * Clean expired password reset tokens
     *
     * @param int $expirySeconds
     */
    public function cleanExpiredPasswordResetTokens($expirySeconds = 86400)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('expirySeconds')
        );

        $this->finder()
            ->cleanExpiredPasswordResetTokens($expirySeconds);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('expirySeconds')
        );
    }

    /**
     * @param $role
     *
     * @return int
     */
    public function countUsersWithRole($role): int
    {
        if (is_string($role)) {
            /**
             * @var $role AclRoleEntity
             */
            $role = $this->_em->getRepository(AclRoleEntity::class)
                ->findOneByName($role);
            if (is_null($role)) {
                return 0;
            }
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('role')
        );
        $roleId = $role->getId();
        $count = $this->connection()->fetchColumn(
            'SELECT COUNT(*) FROM acl_user_to_role WHERE role_id = :role_id',
            ['role_id' => $roleId]
        );
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('role', 'count')
        );
        return $count;
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsWithRole($role): array
    {
        if (is_string($role)) {
            /**
             * @var $role AclRoleEntity
             */
            $role = $this->_em->getRepository(AclRoleEntity::class)
                ->findOneByName($role);
            if (is_null($role)) {
                return [];
            }
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('role')
        );
        $roleId = $role->getId();
        $ids = $this->connection()->fetchArray(
            'SELECT user_id FROM acl_user_to_role WHERE role_id = :role_id',
            ['role_id' => $roleId]
        );
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('role', 'ids')
        );
        return $ids;
    }


    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $users = $this->findAll();
        foreach ($users as $user) {
            $optionList[$user->getId()] = $user->getDisplayName();
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionsList')
        );
        return $optionList;
    }
}
