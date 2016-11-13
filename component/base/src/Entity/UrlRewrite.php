<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Entity;

use WellCart\Base\Spec\UrlRewriteEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class UrlRewrite extends AbstractEntity implements UrlRewriteEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * Request path
     *
     * @var string
     */
    protected $requestPath;

    /**
     * Target path
     *
     * @var string
     */
    protected $targetPath;

    /**
     * @var bool
     */
    protected $isSystem = false;

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
     * @inheritdoc
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): UrlRewriteEntity {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id): UrlRewriteEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): UrlRewriteEntity {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRequestPath()
    {
        return $this->requestPath;
    }

    /**
     * @inheritdoc
     */
    public function setRequestPath($requestPath)
    {
        $this->requestPath = ltrim((string)$requestPath, '/');
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTargetPath()
    {
        return $this->targetPath;
    }

    /**
     * @inheritdoc
     */
    public function setTargetPath($targetPath)
    {
        $this->targetPath = ltrim((string)$targetPath, '/');
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isSystem(): bool
    {
        return (bool)$this->isSystem;
    }

    /**
     * @inheritdoc
     */
    public function setIsSystem(bool $isSystem)
    {
        $this->isSystem = $isSystem;
        return $this;
    }
}
