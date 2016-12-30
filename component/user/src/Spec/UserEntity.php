<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Spec;

use Doctrine\Common\Collections\Collection;
use WellCart\Base\Spec\LocaleLanguageEntity;

interface UserEntity
{

    const STATE_ENABLED = 1;
    const STATE_DISABLED = 0;

    /**
     * Object constructor
     *
     * @return UserEntity
     */
    public function __construct();

    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @return bool
     */
    public function enable(): bool;

    /**
     * @return bool
     */
    public function isDisabled(): bool;

    /**
     * @return bool
     */
    public function disable(): bool;

    /**
     * @return int
     */
    public function getFailedLoginCount();

    /**
     * @param int $failedLoginCount
     *
     * @return UserEntity
     */
    public function setFailedLoginCount($failedLoginCount): UserEntity;

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     *
     * @return UserEntity
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     *
     * @return UserEntity
     */
    public function setLastName($lastName): UserEntity;

    /**
     * @param Collection $roles
     *
     * @return UserEntity
     */
    public function setRoles(Collection $roles): UserEntity;

    /**
     * Perform a deep clone
     *
     * @return UserEntity
     */
    public function __clone();

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return UserEntity
     */
    public function setUsername($username): UserEntity;

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return UserEntity
     */
    public function setEmail($email): UserEntity;

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set displayName.
     *
     * @param string $displayName
     *
     * @return UserEntity
     */
    public function setDisplayName($displayName): UserEntity;

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword();

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return UserEntity
     */
    public function setPassword($password);

    /**
     * Get state.
     *
     * @return int
     */
    public function getState();

    /**
     * Set state.
     *
     * @param int $state
     *
     * @return UserEntity
     */
    public function setState($state): UserEntity;

    /**
     * Get id.
     *
     * @return int
     */
    public function getUserId();

    /**
     * Set id.
     *
     * @param $id
     *
     * @return UserEntity
     */
    public function setUserId($id): UserEntity;

    /**
     * Get the list of roles of this identity
     *
     * @return Collection|string[]
     */
    public function getRoles(): Collection;

    /**
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role): bool;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return UserEntity
     */
    public function setId($id): UserEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface|null $createdAt
     *
     * @return UserEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt = null
    ): UserEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return UserEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): UserEntity;

    /**
     * @param Collection $roles
     *
     * @return UserEntity
     */
    public function addRoles(Collection $roles): UserEntity;

    /**
     * @param AclRoleEntity $role
     *
     * @return UserEntity
     */
    public function addRole(AclRoleEntity $role): UserEntity;

    /**
     * @param Collection $roles
     *
     * @return UserEntity
     */
    public function removeRoles(Collection $roles): UserEntity;

    /**
     * @param AclRoleEntity $role
     *
     * @return UserEntity
     */
    public function removeRole(AclRoleEntity $role
    ): UserEntity;

    /**
     * Retrieve primary role
     *
     * @return AclRoleEntity
     */
    public function primaryRole(): AclRoleEntity;

    /**
     * @return string
     */
    public function getPasswordResetToken();

    /**
     * @param string $passwordResetToken
     *
     * @return UserEntity
     */
    public function setPasswordResetToken($passwordResetToken
    ): UserEntity;

    /**
     * @return string
     */
    public function getEmailConfirmationToken();

    /**
     * @param string $emailConfirmationToken
     *
     * @return UserEntity
     */
    public function setEmailConfirmationToken($emailConfirmationToken
    ): UserEntity;

    /**
     * @return string
     */
    public function getTimeZone();

    /**
     * @param string $timeZone
     *
     * @return UserEntity
     */
    public function setTimeZone($timeZone): UserEntity;

    /**
     * @return LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity $language
     *
     * @return UserEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null);
}
