<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Spec;

use DateTimeInterface;

interface NotificationEntity
{
    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return NotificationEntity
     */
    public function setId($id): NotificationEntity;

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @param string $icon
     *
     * @return NotificationEntity
     */
    public function setIcon($icon): NotificationEntity;

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     *
     * @return NotificationEntity
     */
    public function setTitle($title): NotificationEntity;

    /**
     * @return string
     */
    public function getBody();

    /**
     * @param string $body
     *
     * @return NotificationEntity
     */
    public function setBody($body): NotificationEntity;

    /**
     * @return boolean
     */
    public function isRead(): bool;

    /**
     * @param boolean $isRead
     *
     * @return NotificationEntity
     */
    public function setIsRead($isRead): NotificationEntity;

    /**
     * @return boolean
     */
    public function isDeleted(): bool;

    /**
     * @param boolean $isDeleted
     *
     * @return NotificationEntity
     */
    public function setIsDeleted($isDeleted): NotificationEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt();

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return NotificationEntity
     */
    public function setCreatedAt($createdAt): NotificationEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return NotificationEntity
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt = null
    ): NotificationEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getDeletedAt();

    /**
     * @param \DateTimeInterface $deletedAt
     *
     * @return NotificationEntity
     */
    public function setDeletedAt(DateTimeInterface $deletedAt = null
    ): NotificationEntity;
}
