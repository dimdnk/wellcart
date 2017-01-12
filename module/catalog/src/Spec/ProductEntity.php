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

interface ProductEntity
{

    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return ProductTemplateEntity
     */
    public function getProductTemplate();

    /**
     * @param ProductTemplateEntity $template
     *
     * @return ProductEntity
     */
    public function setProductTemplate(ProductTemplateEntity $template
    ): ProductEntity;

    /**
     * @return int
     */
    public function getBrandId();

    /**
     * @return BrandEntity
     */
    public function getBrand();

    /**
     * @param BrandEntity|null $brand
     *
     * @return ProductEntity
     */
    public function setBrand(BrandEntity $brand = null
    ): ProductEntity;

    /**
     * Perform a deep clone
     *
     * @return ProductEntity
     */
    public function __clone();

    /**
     * @return Collection|ProductEntity[]
     */
    public function getChildren(): Collection;

    /**
     * @param Collection|ProductEntity[] $children
     *
     * @return ProductEntity
     */
    public function setChildren(Collection $children): ProductEntity;

    /**
     * @return Collection|ProductImageEntity[]
     */
    public function getImages(): Collection;

    /**
     * @param Collection|ProductImageEntity[] $images
     *
     * @return ProductEntity
     */
    public function setImages(Collection $images): ProductEntity;

    /**
     * @return Collection|ProductI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|ProductI18nEntity[] $translations
     *
     * @return ProductEntity
     */
    public function setTranslations(Collection $translations
    ): ProductEntity;

    /**
     * @return bool
     */
    public function getStatus(): bool;

    /**
     * @return string
     */
    public function getSku();

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @return string
     */
    public function getUrlKey();

    /**
     * @return int
     */
    public function getParentId();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return ProductEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ProductEntity;

    /**
     * @param Collection $translations
     *
     * @return ProductEntity
     */
    public function addTranslations(Collection $translations
    ): ProductEntity;

    /**
     * @param ProductI18nEntity $translation
     *
     * @return ProductEntity
     */
    public function addTranslation(ProductI18nEntity $translation
    ): ProductEntity;

    /**
     * @param Collection $translations
     *
     * @return ProductEntity
     */
    public function removeTranslations(Collection $translations
    ): ProductEntity;

    /**
     * @param ProductI18nEntity $translation
     *
     * @return ProductEntity
     */
    public function removeTranslation(ProductI18nEntity $translation
    ): ProductEntity;

    /**
     * @param Collection $children
     *
     * @return ProductEntity
     */
    public function addChildren(Collection $children): ProductEntity;

    /**
     * @param ProductEntity $child
     *
     * @return ProductEntity
     */
    public function addChild(ProductEntity $child
    ): ProductEntity;

    /**
     * @param Collection $children
     *
     * @return ProductEntity
     */
    public function removeChildren(Collection $children
    ): ProductEntity;

    /**
     * @param ProductEntity $child
     *
     * @return ProductEntity
     */
    public function removeChild(ProductEntity $child
    ): ProductEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return ProductEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ProductEntity;

    /**
     * @param Collection|CategoryEntity[] $categories
     *
     * @return ProductEntity
     */
    public function addCategories(Collection $categories
    ): ProductEntity;

    /**
     * @param CategoryEntity $category
     *
     * @return ProductEntity
     */
    public function addCategory(CategoryEntity $category
    ): ProductEntity;

    /**
     * @param Collection|CategoryEntity[] $categories
     *
     * @return ProductEntity
     */
    public function removeCategories(Collection $categories
    ): ProductEntity;

    /**
     * @param CategoryEntity $category
     *
     * @return ProductEntity
     */
    public function removeCategory(CategoryEntity $category
    ): ProductEntity;

    /**
     * @return Collection|CategoryEntity[]
     */
    public function getCategories(): Collection;

    /**
     * @return ProductEntity
     */
    public function getParent();

    /**
     * @param ProductEntity|null $parent
     *
     * @return ProductEntity
     */
    public function setParent(ProductEntity $parent = null
    ): ProductEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ProductEntity
     */
    public function setId($id): ProductEntity;

    /**
     * @param Collection|ProductImageEntity[] $images
     *
     * @return ProductEntity
     */
    public function addImages(Collection $images): ProductEntity;

    /**
     * @param Collection|ProductImageEntity[] $image
     *
     * @return ProductEntity
     */
    public function addImage(ProductImageEntity $image
    ): ProductEntity;

    /**
     * @param Collection $images
     *
     * @return ProductEntity
     */
    public function removeImages(Collection $images): ProductEntity;

    /**
     * Remove single image
     *
     * @param ProductImageEntity $image
     *
     * @return ProductEntity
     */
    public function removeImage(ProductImageEntity $image
    ): ProductEntity;

    /**
     * @param Collection|CategoryEntity[] $categories
     *
     * @return ProductEntity
     */
    public function setCategories(Collection $categories
    ): ProductEntity;

    /**
     * @param int $parentId
     *
     * @return ProductEntity
     */
    public function setParentId($parentId): ProductEntity;

    /**
     * @param int $brandId
     *
     * @return ProductEntity
     */
    public function setBrandId($brandId): ProductEntity;


    /**
     * @param boolean $status
     *
     * @return ProductEntity
     */
    public function setStatus($status): ProductEntity;

    /**
     * @param int $sortOrder
     *
     * @return ProductEntity
     */
    public function setSortOrder($sortOrder): ProductEntity;

    /**
     * @param string $urlKey
     *
     * @return ProductEntity
     */
    public function setUrlKey($urlKey): ProductEntity;


    /**
     * @return ProductEntity
     */
    public function noCategories(): ProductEntity;

    /**
     * @return ProductEntity
     */
    public function noImages(): ProductEntity;

    /**
     * @param Collection|ProductVariantEntity[] $images
     *
     * @return ProductEntity
     */
    public function setVariants(Collection $variants): ProductEntity;

    /**
     * @return Collection|ProductVariantEntity[]
     */
    public function getVariants(): Collection;

    /**
     * @param Collection|ProductVariantEntity[] $variants
     *
     * @return ProductEntity
     */
    public function addVariants(Collection $variants): ProductEntity;

    /**
     * @param Collection|ProductVariantEntity[] $variant
     *
     * @return ProductEntity
     */
    public function addVariant(ProductVariantEntity $variant
    ): ProductEntity;

    /**
     * @param Collection $variants
     *
     * @return ProductEntity
     */
    public function removeVariants(Collection $variants): ProductEntity;

    /**
     * Remove single variant
     *
     * @param ProductVariantEntity $variant
     *
     * @return ProductEntity
     */
    public function removeVariant(ProductVariantEntity $variant
    ): ProductEntity;

    /**
     * @return Collection|FeatureCombinationEntity[]
     */
    public function getFeatures(): Collection;

    /**
     * @param Collection|FeatureCombinationEntity[] $features
     *
     * @return ProductEntity
     */
    public function setFeatures(Collection $features): ProductEntity;

    /**
     * @param Collection|FeatureCombinationEntity[] $features
     *
     * @return ProductEntity
     */
    public function addFeatures(Collection $features): ProductEntity;

    /**
     * @param FeatureCombinationEntity $feature
     *
     * @return ProductEntity
     */
    public function addFeature(FeatureCombinationEntity $feature
    ): ProductEntity;

    /**
     * @param Collection|FeatureCombinationEntity[] $features
     *
     * @return ProductEntity
     */
    public function removeFeatures(Collection $features): ProductEntity;

    /**
     * Remove single feature combination
     *
     * @param FeatureCombinationEntity $feature
     *
     * @return ProductEntity
     */
    public function removeFeature(FeatureCombinationEntity $feature
    ): ProductEntity;
}
