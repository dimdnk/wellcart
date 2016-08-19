<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use Doctrine\Common\Collections\Collection;

interface BrandEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @param int $id
     *
     * @return BrandEntity
     */
    public function setId($id): BrandEntity;

    /**
     * @param string $name
     *
     * @return BrandEntity
     */
    public function setName($name): BrandEntity;

    /**
     * @param string $imageFullPath
     *
     * @return BrandEntity
     */
    public function setImageFullPath($imageFullPath): BrandEntity;

    /**
     * @param string $metaTitle
     *
     * @return BrandEntity
     */
    public function setMetaTitle($metaTitle): BrandEntity;

    /**
     * @param string $metaKeywords
     *
     * @return BrandEntity
     */
    public function setMetaKeywords($metaKeywords): BrandEntity;

    /**
     * @param string $metaDescription
     *
     * @return BrandEntity
     */
    public function setMetaDescription($metaDescription): BrandEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getImageFullPath();

    /**
     * Determine image availability
     *
     * @return bool
     */
    public function hasImage();

    /**
     * @return string
     */
    public function getMetaTitle();

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return BrandEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): BrandEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return BrandEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): BrandEntity;

    /**
     * @return Collection|ProductEntity[]
     */
    public function getProducts(): Collection;

    /**
     * @param Collection|ProductEntity[] $products
     *
     * @return BrandEntity
     */
    public function setProducts(Collection $products): BrandEntity;
}
