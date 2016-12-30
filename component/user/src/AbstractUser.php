<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User;

use Doctrine\Common\Collections\Collection;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\User\Exception\DomainException;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\UserEntity;
use WellCart\Utility\Config;
use WellCart\Utility\Time;
use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\UserInterface as ZfcUserInterface;

class AbstractUser extends AbstractEntity implements
    ZfcUserInterface,
    IdentityInterface,
    UserEntity
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var
     */
    protected $state = UserEntity::STATE_ENABLED;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $passwordResetToken;

    /**
     * @var string
     */
    protected $emailConfirmationToken;

    /**
     * @var integer
     */
    protected $failedLoginCount = 0;

    /**
     * @var Collection|AclRoleEntity[]
     */
    protected $roles;

    /**
     * @var string
     */
    protected $timeZone;

    /**
     * @var LocaleLanguageEntity
     */
    protected $language;

    /**
     * Created at
     *
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * Updated at
     *
     * @var \DateTimeInterface
     */
    protected $updatedAt;

    /**
     * @return int
     */
    public function getFailedLoginCount()
    {
        return $this->failedLoginCount;
    }

    /**
     * @param int $failedLoginCount
     *
     * @return  UserEntity
     */
    public function setFailedLoginCount($failedLoginCount): UserEntity
    {
        $this->failedLoginCount = abs((int)$failedLoginCount);
        return $this;
    }

    /**
     * Perform a deep clone
     *
     * @return UserEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * Object constructor
     *
     * @return UserEntity
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
        $this->roles = new ArrayCollection;
    }

    /**
     * Get username.
     *
     * @return string
     */
    final public function getUsername()
    {
        return null;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return UserEntity
     */
    final public function setUsername($username): UserEntity
    {
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return UserEntity
     */
    public function setEmail($email): UserEntity
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    final public function getDisplayName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return  UserEntity
     */
    public function setFirstName($firstName): UserEntity
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return UserEntity
     */
    public function setLastName($lastName): UserEntity
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     *
     * @return UserEntity
     */
    final public function setDisplayName($displayName): UserEntity
    {
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return UserEntity
     */
    public function setPassword($password): UserEntity
    {
        if (!empty($password)) {
            $this->password = $password;
        }
        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param $id
     *
     * @return UserEntity
     */
    public function setUserId($id): UserEntity
    {
        $this->id = (int)$id;
        return $this;
    }

    /**
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role): bool
    {
        if ($role instanceof AclRoleEntity) {
            $role = $role->getName();
        }
        foreach ($this->getRoles() as $entity) {
            if ($entity->getName() == $role) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the list of roles of this identity
     *
     * @return Collection|string[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * @param Collection $roles
     *
     * @return UserEntity
     */
    public function setRoles(Collection $roles): UserEntity
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return UserEntity
     */
    public function setId($id): UserEntity
    {
        $this->id = (int)$id;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     *
     * @return UserEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt = null
    ): UserEntity {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return UserEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): UserEntity {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Retrieve primary role
     *
     * @return AclRoleEntity
     */
    public function primaryRole(): AclRoleEntity
    {
        if (!$this->roles->count()) {
            throw new DomainException(
                'Primary role must be assigned to the user account.'
            );
        }
        return $this->roles->first();
    }

    /**
     * @param Collection $roles
     *
     * @return UserEntity
     */
    public function addRoles(Collection $roles): UserEntity
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    /**
     * @param AclRoleEntity $role
     *
     * @return UserEntity
     */
    public function addRole(AclRoleEntity $role): UserEntity
    {
        if ($this->roles->contains($role)) {
            return $this;
        }
        $this->roles->add($role);
        return $this;
    }

    /**
     * @param Collection $roles
     *
     * @return UserEntity
     */
    public function removeRoles(Collection $roles): UserEntity
    {
        foreach ($roles as $role) {
            $this->removeRole($role);
        }
        return $this;
    }

    /**
     * @param AclRoleEntity $role
     *
     * @return UserEntity
     */
    public function removeRole(AclRoleEntity $role
    ): UserEntity {
        $role->getUsers()->removeElement($this);
        $this->roles->removeElement($role);
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordResetToken()
    {
        return $this->passwordResetToken;
    }

    /**
     * @param string $passwordResetToken
     *
     * @return UserEntity
     */
    public function setPasswordResetToken($passwordResetToken
    ): UserEntity {
        $this->passwordResetToken = $passwordResetToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailConfirmationToken()
    {
        return $this->emailConfirmationToken;
    }

    /**
     * @param string $emailConfirmationToken
     *
     * @return UserEntity
     */
    public function setEmailConfirmationToken($emailConfirmationToken
    ): UserEntity {
        $this->emailConfirmationToken = $emailConfirmationToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return ($this->timeZone)
            ?: Config::get(
                'wellcart.localization.timezone'
            );
    }

    /**
     * @param string $timeZone
     *
     * @return UserEntity
     */
    public function setTimeZone($timeZone): UserEntity
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * @return LocaleLanguageEntity
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LocaleLanguageEntity $language
     *
     * @return UserEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ($this->getState() === UserEntity::STATE_ENABLED);
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $state
     *
     * @return UserEntity
     */
    public function setState($state): UserEntity
    {
        $this->state = (int)$state;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return ($this->getState() === UserEntity::STATE_DISABLED);
    }

    /**
     * @return bool
     */
    public function enable(): bool
    {
        $this->setState(UserEntity::STATE_ENABLED);
        return true;
    }

    /**
     * @return bool
     */
    public function disable(): bool
    {
        $this->setState(UserEntity::STATE_DISABLED);
        return true;
    }
}
