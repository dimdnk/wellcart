<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Spec;

interface UrlRewriteEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return UrlRewriteEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): UrlRewriteEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return UrlRewriteEntity
     */
    public function setId($id): UrlRewriteEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return UrlRewriteEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): UrlRewriteEntity;

    /**
     * @return string
     */
    public function getRequestPath();

    /**
     * @param string $requestPath
     *
     * @return UrlRewriteEntity
     */
    public function setRequestPath($requestPath);

    /**
     * @return string
     */
    public function getTargetPath();

    /**
     * @param string $targetPath
     *
     * @return UrlRewriteEntity
     */
    public function setTargetPath($targetPath);

    /**
     * @return bool
     */
    public function isSystem(): bool;

    /**
     * @param boolean $isSystem
     *
     * @return UrlRewriteEntity
     */
    public function setIsSystem(bool $isSystem);
}
