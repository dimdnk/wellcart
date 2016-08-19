<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

interface ProductImageEntity
{

    /**
     * @return ProductEntity
     */
    public function getProduct();

    /**
     * @param ProductEntity|null $product
     *
     * @return ProductEntity
     */
    public function setProduct(ProductEntity $product = null
    ):ProductImageEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ProductImageEntity
     */
    public function setId($id): ProductImageEntity;

    /**
     * @return string
     */
    public function getFullPath();

    /**
     * @param string $fullPath
     *
     * @return ProductImageEntity
     */
    public function setFullPath($fullPath): ProductImageEntity;

    /**
     * @return string
     */
    public function getFilename();

    /**
     * @param string $filename
     *
     * @return ProductImageEntity
     */
    public function setFilename($filename): ProductImageEntity;

    /**
     * @return string
     */
    public function getOriginalFilename();

    /**
     * @param string $originalFilename
     *
     * @return ProductImageEntity
     */
    public function setOriginalFilename($originalFilename
    ): ProductImageEntity;

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return ProductImageEntity
     */
    public function setDescription($description): ProductImageEntity;

    /**
     * @return int
     */
    public function getImageX();

    /**
     * @param int $imageX
     *
     * @return ProductImageEntity
     */
    public function setImageX($imageX);

    /**
     * @return int
     */
    public function getImageY();

    /**
     * @param int $imageY
     *
     * @return ProductImageEntity
     */
    public function setImageY($imageY): ProductImageEntity;

    /**
     * @return bool
     */
    public function isBase(): bool;

    /**
     * @param boolean $isBase
     *
     * @return ProductImageEntity
     */
    public function setIsBase($isBase);

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return ProductImageEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ProductImageEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return ProductImageEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ProductImageEntity;
}
