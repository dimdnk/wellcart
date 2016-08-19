<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Entity\Acl;

use Doctrine\Common\Collections\Collection;
use WellCart\ORM\EntityTrait;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\User\Spec\AclPermissionEntity;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\UserEntity;
use WellCart\Utility\Time;
use Zend\Permissions\Rbac\AbstractRole;

class Role extends AbstractRole implements AclRoleEntity
{
    use EntityTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var Role
     */
    protected $parent;

    /**
     * @var Collection|AclRoleEntity[]
     */
    protected $children;

    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection|UserEntity[]
     */
    protected $users;

    /**
     * @var Collection|AclPermissionEntity[]
     */
    protected $permissions;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var bool
     */
    protected $isSystem = false;

    /**
     * @var bool
     */
    protected $isDefault = false;

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
     * @param int $index
     *
     * @return AclRoleEntity
     */
    public function setIndex($index)
    {
        $this->index = $index;
        return $this;
    }

    /**
     * Perform a deep clone
     *
     * @return AclRoleEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * Object constructor
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
        $this->users = new ArrayCollection;
        $this->permissions = new ArrayCollection;
        $this->children = new ArrayCollection();
    }

    /**
     * @return AclRoleEntity
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param $parent
     *
     * @return AclRoleEntity
     */
    public function setParent($parent): AclRoleEntity
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Check if the role has children
     *
     * @return bool
     */
    public function hasChildren()
    {
        return ($this->children->isEmpty() === false);
    }

    /**
     * @return Collection|AclRoleEntity[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection|AclRoleEntity[] $children
     *
     * @return AclRoleEntity
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return Collection|AclPermissionEntity[]
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * @param Collection|AclPermissionEntity[] $permissions
     *
     * @return AclRoleEntity
     */
    public function setPermissions($permissions): AclRoleEntity
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return Collection|UserEntity[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param Collection|UserEntity[] $users
     *
     * @return AclRoleEntity
     */
    public function setUsers(Collection $users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @param Collection|UserEntity[] $users
     *
     * @return AclRoleEntity
     */
    public function addUsers(Collection $users): AclRoleEntity
    {
        foreach ($users as $user) {
            $this->addUser($user);
        }
        return $this;
    }

    /**
     * @param UserEntity $user
     *
     * @return AclRoleEntity
     */
    public function addUser(UserEntity $user): AclRoleEntity
    {
        if ($this->users->contains($user)) {
            return $this;
        }

        $this->users->add($user);
        return $this;
    }

    /**
     * @param Collection|UserEntity[] $users
     *
     * @return AclRoleEntity
     */
    public function removeUsers(Collection $users): AclRoleEntity
    {
        foreach ($users as $user) {
            $this->removeUser($user);
        }
        return $this;
    }

    /**
     * @param UserEntity $user
     *
     * @return AclRoleEntity
     */
    public function removeUser(UserEntity $user
    ): AclRoleEntity
    {
        $this->users->removeElement($user);
        return $this;
    }

    /**
     * @param Collection|AclPermissionEntity[] $permissions
     *
     * @return AclRoleEntity
     */
    public function addPermissions(Collection $permissions
    ): AclRoleEntity
    {
        foreach ($permissions as $permission) {
            $this->addPermission($permission);
        }
        return $this;
    }

    /**
     * @param UserEntity $user
     *
     * @return AclRoleEntity
     */
    public function addPermission($permission): AclRoleEntity
    {
        if ($this->permissions->contains($permission)) {
            return $this;
        }

        $this->permissions->add($permission);
        return $this;
    }


    /**
     * @param Collection|AclPermissionEntity[] $permissions
     *
     * @return AclRoleEntity
     */
    public function removePermissions(Collection $permissions
    ): AclRoleEntity
    {
        foreach ($permissions as $permission) {
            $this->removePermission($permission);
        }
        return $this;
    }

    /**
     * @param AclPermissionEntity $permission
     *
     * @return AclRoleEntity
     */
    public function removePermission(AclPermissionEntity $permission
    ): AclRoleEntity
    {
        $this->permissions->removeElement($permission);
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return AclRoleEntity
     */
    public function setDescription($description): AclRoleEntity
    {
        $this->description = $description;
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
     * @param \DateTimeInterface $createdAt
     *
     * @return AclRoleEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): AclRoleEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return AclRoleEntity
     */
    public function setId($id): AclRoleEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     *
     * @return AclRoleEntity
     */
    public function setIsDefault($isDefault): AclRoleEntity
    {
        $this->isDefault = (bool)$isDefault;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     *
     * @return AclRoleEntity
     */
    public function setParentId($parentId): AclRoleEntity
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return (string)$this;
    }

    /**
     * @return bool
     */
    public function isSystem(): bool
    {
        return $this->isSystem;
    }

    /**
     * @param boolean $isSystem
     *
     * @return AclRoleEntity
     */
    public function setIsSystem($isSystem): AclRoleEntity
    {
        $this->isSystem = (bool)$isSystem;
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
     * @return AclRoleEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): AclRoleEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return AclRoleEntity
     */
    public function setName($name): AclRoleEntity
    {
        $this->name = $name;
        return $this;
    }
}
