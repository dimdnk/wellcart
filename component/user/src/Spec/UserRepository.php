<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Spec;

use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;

interface UserRepository extends Repository
{

    /**
     * Find user by email
     *
     * @param $email
     *
     * @return null|UserEntity
     */
    public function findOneByEmail($email);

    /**
     * Find user by password reset token
     *
     * @param $token
     *
     * @return null|UserEntity
     */
    public function findOneByPasswordResetToken($token);

    /**
     * Find user by email confirmation token
     *
     * @param $token
     *
     * @return null|UserEntity
     */
    public function findOneByEmailConfirmationToken($token);

    /**
     * @param $token
     *
     * @return bool
     */
    public function isPasswordTokenExists($token): bool;

    /**
     * Creates a new QueryBuilder instance with predefined root alias.
     *
     * @return QueryBuilder
     */
    public function finder();

    /**
     * Creates a new QueryBuilder instance.
     *
     * @param  string     $alias
     * @param null|string $indexBy
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null);

    /**
     * @param $token
     *
     * @return bool
     */
    public function isEmailConfirmationTokenExists($token): bool;

    /**
     * @param $role
     *
     * @return int
     */
    public function countUsersWithRole($role): int;

    /**
     * @param $role
     *
     * @return array
     */
    public function getUserIdsWithRole($role): array;

    /**
     * Clean expired password reset tokens
     *
     * @param int $expirySeconds
     */
    public function cleanExpiredPasswordResetTokens($expirySeconds = 86400);

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array;
}
