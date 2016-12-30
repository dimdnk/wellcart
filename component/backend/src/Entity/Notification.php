<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Entity;

use DateTimeInterface;
use WellCart\Backend\Spec\NotificationEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Notification extends AbstractEntity implements NotificationEntity
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $icon;
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var bool
     */
    protected $isRead = false;

    /**
     * @var bool
     */
    protected $isDeleted = false;

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
     * Updated at
     *
     * @var \DateTimeInterface
     */
    protected $deletedAt;

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
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
     * @return NotificationEntity
     */
    public function setId($id): NotificationEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return NotificationEntity
     */
    public function setIcon($icon): NotificationEntity
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return NotificationEntity
     */
    public function setTitle($title): NotificationEntity
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return NotificationEntity
     */
    public function setBody($body): NotificationEntity
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRead(): bool
    {
        return (bool)$this->isRead;
    }

    /**
     * @param boolean $isRead
     *
     * @return NotificationEntity
     */
    public function setIsRead($isRead): NotificationEntity
    {
        $this->isRead = (bool)$isRead;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return (bool)$this->isDeleted;
    }

    /**
     * @param boolean $isDeleted
     *
     * @return NotificationEntity
     */
    public function setIsDeleted($isDeleted): NotificationEntity
    {
        $this->isDeleted = (bool)$isDeleted;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return NotificationEntity
     */
    public function setCreatedAt($createdAt): NotificationEntity
    {
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
     * @param \DateTimeInterface $updatedAt
     *
     * @return NotificationEntity
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt = null
    ): NotificationEntity {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTimeInterface $deletedAt
     *
     * @return NotificationEntity
     */
    public function setDeletedAt(DateTimeInterface $deletedAt = null
    ): NotificationEntity {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}
