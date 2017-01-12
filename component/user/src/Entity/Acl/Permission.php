<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Entity\Acl;

use Doctrine\Common\Collections\Collection;
use WellCart\ORM\AbstractEntity;
use WellCart\User\Spec\AclPermissionEntity;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\Utility\Time;

class Permission extends AbstractEntity implements AclPermissionEntity
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $isSystem = true;

    /**
     * @var Collection|AclRoleEntity[]
     */
    protected $roles;

    /**
     * @var string
     */
    protected $description;

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
     * Object constructor
     *
     */
    public function __construct($name)
    {
        $this->setCreatedAt(new Time());
        $this->setName($name);
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
     * @return AclPermissionEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): AclPermissionEntity {
        $this->createdAt = $createdAt;

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
     * @return AclPermissionEntity
     */
    public function setDescription($description): AclPermissionEntity
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSystem(): bool
    {
        return boolval($this->isSystem);
    }

    /**
     * @param boolean $isSystem
     *
     * @return AclPermissionEntity
     */
    public function setIsSystem($isSystem)
    {
        $this->isSystem = (bool)$isSystem;

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
     * @return AclPermissionEntity
     */
    public function setId($id): AclPermissionEntity
    {
        $this->id = $id;

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
     * @return AclPermissionEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): AclPermissionEntity {
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
     * @return AclPermissionEntity
     */
    public function setName($name): AclPermissionEntity
    {
        $this->name = $name;

        return $this;
    }
}
