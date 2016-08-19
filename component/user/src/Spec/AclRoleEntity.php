<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Spec;

use Doctrine\Common\Collections\Collection;
use Rbac\Role\HierarchicalRoleInterface;
use Rbac\Role\RoleInterface as RbacRoleInterface;
use WellCart\ORM\Entity;
use Zend\Permissions\Acl\Role\RoleInterface as ZendPermissionsAclRoleInterface;
use Zend\Permissions\Rbac\RoleInterface as ZendPermissionsRbacRoleInterface;

interface AclRoleEntity extends
    ZendPermissionsRbacRoleInterface,
    ZendPermissionsAclRoleInterface,
    RbacRoleInterface,
    HierarchicalRoleInterface,
    Entity
{

    /**
     * Object constructor
     *
     * @return AclRoleEntity
     */
    public function __construct();

    /**
     * @param int $index
     *
     * @return AclRoleEntity
     */
    public function setIndex($index);

    /**
     * Perform a deep clone
     *
     * @return AclRoleEntity
     */
    public function __clone();

    /**
     * @return AclRoleEntity
     */
    public function getParent();

    /**
     * @param $parent
     *
     * @return AclRoleEntity
     */
    public function setParent($parent);

    /**
     * @return Collection|AclRoleEntity[]
     */
    public function getChildren(): Collection;

    /**
     * @param Collection|AclRoleEntity[] $children
     *
     * @return AclRoleEntity
     */
    public function setChildren($children);

    /**
     * @return Collection|AclPermissionEntity[]
     */
    public function getPermissions(): Collection;

    /**
     * @param Collection|AclPermissionEntity[] $permission
     *
     * @return AclRoleEntity
     */
    public function setPermissions($permission);

    /**
     * @return int
     */
    public function getIndex();

    /**
     * @return Collection|UserEntity[]
     */
    public function getUsers(): Collection;

    /**
     * @param Collection|UserEntity[] $users
     *
     * @return AclRoleEntity
     */
    public function setUsers(Collection $users);

    /**
     * @param Collection|UserEntity[] $users
     *
     * @return AclRoleEntity
     */
    public function addUsers(Collection $users): AclRoleEntity;

    /**
     * @param UserEntity $user
     *
     * @return AclRoleEntity
     */
    public function addUser(UserEntity $user): AclRoleEntity;

    /**
     * @param Collection|UserEntity[] $users
     *
     * @return AclRoleEntity
     */
    public function removeUsers(Collection $users): AclRoleEntity;

    /**
     * @param UserEntity $user
     *
     * @return AclRoleEntity
     */
    public function removeUser(UserEntity $user
    ): AclRoleEntity;

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return AclRoleEntity
     */
    public function setDescription($description);

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return AclRoleEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AclRoleEntity
     */
    public function setId($id): AclRoleEntity;

    /**
     * @param bool $isDefault
     *
     * @return AclRoleEntity
     */
    public function setIsDefault($isDefault);

    /**
     * @return int
     */
    public function getParentId();

    /**
     * @param int $parentId
     *
     * @return AclRoleEntity
     */
    public function setParentId($parentId): AclRoleEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return AclRoleEntity
     */
    public function setName($name): AclRoleEntity;

    /**
     * @return bool
     */
    public function isSystem(): bool;

    /**
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * @param boolean $isSystem
     *
     * @return AclRoleEntity
     */
    public function setIsSystem($isSystem): AclRoleEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return AclRoleEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): AclRoleEntity;

    /**
     * @param Collection|AclPermissionEntity[] $permissions
     *
     * @return AclRoleEntity
     */
    public function addPermissions(Collection $permissions
    ): AclRoleEntity;


    /**
     * @param Collection|AclPermissionEntity[] $permissions
     *
     * @return AclRoleEntity
     */
    public function removePermissions(Collection $permissions
    ): AclRoleEntity;

    /**
     * @param AclPermissionEntity $permission
     *
     * @return AclRoleEntity
     */
    public function removePermission(AclPermissionEntity $permission
    ): AclRoleEntity;

    /**
     * @param UserEntity $user
     *
     * @return AclRoleEntity
     */
    public function addPermission($permission): AclRoleEntity;

    /**
     * @return string
     */
    public function __toString(): string;
}
