<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use Doctrine\Common\Collections\Collection;

interface CategoryEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return CategoryEntity
     */
    public function __clone();

    /**
     * @return Collection|ProductEntity[]
     */
    public function getProducts(): Collection;

    /**
     * @return Collection|CategoryI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|CategoryI18nEntity[] $translations
     *
     * @return CategoryEntity
     */
    public function setTranslations(Collection $translations
    ): CategoryEntity;

    /**
     * @param Collection $translations
     *
     * @return CategoryEntity
     */
    public function addTranslations(Collection $translations
    ): CategoryEntity;

    /**
     * @param CategoryI18nEntity $translation
     *
     * @return CategoryEntity
     */
    public function addTranslation(CategoryI18nEntity $translation
    ): CategoryEntity;

    /**
     * @param Collection $translations
     *
     * @return CategoryEntity
     */
    public function removeTranslations(Collection $translations
    ): CategoryEntity;

    /**
     * Remove single related translation
     *
     * @param CategoryI18nEntity $translation
     *
     * @return CategoryEntity
     */
    public function removeTranslation(CategoryI18nEntity $translation
    ): CategoryEntity;

    /**
     * @return int
     */
    public function getLft();

    /**
     * @return int
     */
    public function getRgt();

    /**
     * @return int
     */
    public function getRoot();

    /**
     * @return int
     */
    public function getLvl();

    /**
     * @return CategoryEntity
     */
    public function getParent();

    /**
     * @param CategoryEntity|null $parent
     *
     * @return CategoryEntity
     */
    public function setParent(CategoryEntity $parent = null);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return CategoryEntity
     */
    public function setId($id): CategoryEntity;

    /**
     * @return CategoryEntity
     */
    public function getChildren();

    /**
     * @param Collection $children
     *
     * @return CategoryEntity
     */
    public function setChildren(Collection $children): CategoryEntity;

    /**
     * @param Collection $children
     *
     * @return CategoryEntity
     */
    public function addChildren(Collection $children): CategoryEntity;

    /**
     * @param CategoryEntity $child
     *
     * @return CategoryEntity
     */
    public function addChild(CategoryEntity $child
    ): CategoryEntity;

    /**
     * @param Collection $children
     *
     * @return CategoryEntity
     */
    public function removeChildren(Collection $children
    ): CategoryEntity;

    /**
     * @param CategoryEntity $child
     *
     * @return CategoryEntity
     */
    public function removeChild(CategoryEntity $child
    ): CategoryEntity;

    /**
     * @return bool
     */
    public function isVisible(): bool;

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @return string
     */
    public function getUrlKey();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return CategoryEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return CategoryEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null);

    /**
     * @param Collection $products
     *
     * @return CategoryEntity
     */
    public function addProducts(Collection $products): CategoryEntity;

    /**
     * @param ProductEntity $product
     *
     * @return CategoryEntity
     */
    public function addProduct(ProductEntity $product
    ): CategoryEntity;

    /**
     * @param Collection $products
     *
     * @return CategoryEntity
     */
    public function removeProducts(Collection $products
    ): CategoryEntity;

    /**
     * @param ProductEntity $product
     *
     * @return CategoryEntity
     */
    public function removeProduct(ProductEntity $product
    ): CategoryEntity;

    /**
     * @param Collection|ProductEntity[] $products
     *
     * @return CategoryEntity
     */
    public function setProducts(Collection $products): CategoryEntity;

    /**
     * @param int $lft
     *
     * @return CategoryEntity
     */
    public function setLft($lft): CategoryEntity;

    /**
     * @param int $rgt
     *
     * @return CategoryEntity
     */
    public function setRgt($rgt): CategoryEntity;

    /**
     * @param int $root
     *
     * @return CategoryEntity
     */
    public function setRoot($root): CategoryEntity;

    /**
     * @param int $lvl
     *
     * @return CategoryEntity
     */
    public function setLvl($lvl): CategoryEntity;

    /**
     * @param boolean $isVisible
     *
     * @return CategoryEntity
     */
    public function setIsVisible($isVisible): CategoryEntity;

    /**
     * @param int $sortOrder
     *
     * @return CategoryEntity
     */
    public function setSortOrder($sortOrder): CategoryEntity;

    /**
     * @param string $urlKey
     *
     * @return CategoryEntity
     */
    public function setUrlKey($urlKey): CategoryEntity;
}
