<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Spec;

interface AclPermissionEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct($name);

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return AclPermissionEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): AclPermissionEntity;

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return AclPermissionEntity
     */
    public function setDescription($description): AclPermissionEntity;

    /**
     * @return bool
     */
    public function isSystem(): bool;

    /**
     * @param boolean $isSystem
     *
     * @return AclPermissionEntity
     */
    public function setIsSystem($isSystem);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AclPermissionEntity
     */
    public function setId($id): AclPermissionEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return AclPermissionEntity
     */
    public function setName($name): AclPermissionEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return AclPermissionEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): AclPermissionEntity;

    /**
     * @return string
     */
    public function __toString(): string;
}
