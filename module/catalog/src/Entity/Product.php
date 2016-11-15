<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use Doctrine\Common\Collections\Collection;
use WellCart\Catalog\Spec\BrandEntity;
use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\FeatureCombinationEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductI18nEntity;
use WellCart\Catalog\Spec\ProductImageEntity;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductVariantEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Utility\Time;

class Product extends AbstractEntity implements TranslatableEntity, ProductEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var Collection|ProductI18nEntity[]
     */
    protected $translations;

    /**
     * @var Collection|CategoryEntity[]
     */
    protected $categories;

    /**
     * @var Collection|ProductImageEntity[]
     */
    protected $images;

    /**
     * @var Collection|ProductVariantEntity[]
     */
    protected $variants;

    /**
     * @var Collection|FeatureCombinationEntity[]
     */
    protected $features;

    /**
     * @var Product
     */
    protected $parent;

    /**
     * @var Collection|ProductEntity[]
     */
    protected $children;

    /**
     * Parent
     *
     * @var int
     */
    protected $parentId;

    /**
     * @var int
     */
    protected $brandId;

    /**
     * @var BrandEntity
     */
    protected $brand;

    /**
     * @var ProductTemplateEntity
     */
    protected $productTemplate;

    /**
     * @var bool
     */
    protected $status = ProductEntity::STATUS_ENABLED;

    /**
     * @var int
     */
    protected $sortOrder = 0;

    /**
     * @var string
     */
    protected $urlKey;

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
    public function __construct()
    {
        $this->setCreatedAt(new Time());
        $this->translations = new ArrayCollection();
        $this->images = new ArrayCollection();

        $this->categories = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->variants = new ArrayCollection();
        $this->features = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     *
     * @return ProductEntity
     */
    public function setBrandId($brandId): ProductEntity
    {
        $this->brandId = $brandId;
        return $this;
    }

    /**
     * @return BrandEntity
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param BrandEntity|null $brand
     *
     * @return ProductEntity
     */
    public function setBrand(BrandEntity $brand = null
    ): ProductEntity
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return ProductTemplateEntity
     */
    public function getProductTemplate()
    {
        return $this->productTemplate;
    }

    /**
     * @inheritdoc
     */
    public function setProductTemplate(ProductTemplateEntity $template
    ): ProductEntity
    {
        $this->productTemplate = $template;
        return $this;
    }

    /**
     * Perform a deep clone
     *
     * @return ProductEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * @return Collection|ProductEntity[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection|ProductEntity[] $children
     *
     * @return ProductEntity
     */
    public function setChildren(Collection $children): ProductEntity
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return Collection|ProductI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|ProductI18nEntity[] $translations
     *
     * @return ProductEntity
     */
    public function setTranslations(Collection $translations
    ): ProductEntity
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return (bool)$this->status;
    }

    /**
     * @param boolean $status
     *
     * @return ProductEntity
     */
    public function setStatus($status): ProductEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     *
     * @return ProductEntity
     */
    public function setSortOrder($sortOrder): ProductEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getUrlKey()
    {
        return $this->urlKey;
    }

    /**
     * @param string $urlKey
     *
     * @return ProductEntity
     */
    public function setUrlKey($urlKey): ProductEntity
    {
        $this->urlKey = $urlKey;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     *
     * @return ProductEntity
     */
    public function setParentId($parentId): ProductEntity
    {
        $this->parentId = $parentId;
        return $this;
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
     * @return ProductEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ProductEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param Collection|ProductI18nEntity[] $translations
     *
     * @return ProductEntity
     */
    public function addTranslations(Collection $translations
    ): ProductEntity
    {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
        return $this;
    }

    /**
     * @param ProductI18nEntity $translation
     *
     * @return ProductEntity
     */
    public function addTranslation(ProductI18nEntity $translation
    ): ProductEntity
    {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setProduct($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|ProductI18nEntity[] $translations
     *
     * @return ProductEntity
     */
    public function removeTranslations(Collection $translations
    ): ProductEntity
    {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * @param ProductI18nEntity $translation
     *
     * @return ProductEntity
     */
    public function removeTranslation(ProductI18nEntity $translation
    ): ProductEntity
    {
        $translation->setProduct(null);
        $this->translations->removeElement($translation);
        return $this;
    }

    /**
     * @param Collection|ProductEntity[] $children
     *
     * @return ProductEntity
     */
    public function addChildren(Collection $children): ProductEntity
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }
        return $this;
    }

    /**
     * @param ProductEntity $child
     *
     * @return ProductEntity
     */
    public function addChild(ProductEntity $child
    ): ProductEntity
    {
        if ($this->children->contains($child)) {
            return $this;
        }

        $child->setParent($this);
        $this->children->add($child);
        return $this;
    }

    /**
     * @param Collection|ProductEntity[] $children
     *
     * @return ProductEntity
     */
    public function removeChildren(Collection $children): ProductEntity
    {
        foreach ($children as $child) {
            $this->removeChild($child);
        }
        return $this;
    }

    /**
     * @param ProductEntity $child
     *
     * @return ProductEntity
     */
    public function removeChild(ProductEntity $child
    ): ProductEntity
    {
        $child->setParent(null);
        $this->children->removeElement($child);
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
     * @return ProductEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ProductEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param Collection|CategoryEntity[] $categories
     *
     * @return ProductEntity
     */
    public function addCategories(Collection $categories
    ): ProductEntity
    {
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
        return $this;
    }

    /**
     * @param CategoryEntity $category
     *
     * @return ProductEntity
     */
    public function addCategory(CategoryEntity $category
    ): ProductEntity
    {
        if ($this->categories->contains($category)) {
            return $this;
        }
        $this->categories->add($category);
        return $this;
    }

    /**
     * @param Collection|CategoryEntity[] $categories
     *
     * @return ProductEntity
     */
    public function removeCategories(Collection $categories
    ): ProductEntity
    {
        foreach ($categories as $category) {
            $this->removeCategory($category);
        }
        return $this;
    }

    /**
     * @param CategoryEntity $category
     *
     * @return ProductEntity
     */
    public function removeCategory(CategoryEntity $category
    ): ProductEntity
    {
        $this->categories->removeElement($category);
        return $this;
    }

    /**
     * @return ProductEntity
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param ProductEntity|null $parent
     *
     * @return ProductEntity
     */
    public function setParent(ProductEntity $parent = null
    ): ProductEntity
    {
        $parentId = null;
        if ($parent) {
            $parentId = $parent->getId();
        }

        $this->parent = $parent;
        $this->setParentId($parentId);
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
     * @return ProductEntity
     */
    public function setId($id): ProductEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param Collection|ProductImageEntity[] $images
     *
     * @return ProductEntity
     */
    public function addImages(Collection $images): ProductEntity
    {
        foreach ($images as $image) {
            $this->addImage($image);
        }
        return $this;
    }

    /**
     * @param ProductImageEntity $image
     *
     * @return ProductEntity
     */
    public function addImage(ProductImageEntity $image
    ): ProductEntity
    {
        if ($this->images->contains($image)) {
            return $this;
        }
        $image->setProduct($this);
        $this->images->add($image);
        return $this;
    }

    /**
     * @param Collection|ProductImageEntity[] $images
     *
     * @return ProductEntity
     */
    public function removeImages(Collection $images): ProductEntity
    {
        foreach ($images as $image) {
            $this->removeImage($image);
        }
        return $this;
    }

    /**
     * Remove single image
     *
     * @param ProductImageEntity $image
     *
     * @return ProductEntity
     */
    public function removeImage(ProductImageEntity $image
    ): ProductEntity
    {
        $image->setProduct(null);
        $this->images->removeElement($image);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function noCategories(): ProductEntity
    {
        $this->getCategories()->clear();
        return $this;
    }

    /**
     * @return Collection|CategoryEntity[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection|CategoryEntity[] $categories
     *
     * @return ProductEntity
     */
    public function setCategories(Collection $categories
    ): ProductEntity
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return ProductEntity
     */
    public function noImages(): ProductEntity
    {
        $this->getImages()->clear();
        return $this;
    }

    /**
     * @return Collection|ProductImageEntity[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Collection|ProductImageEntity[] $images
     *
     * @return ProductEntity
     */
    public function setImages(Collection $images): ProductEntity
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Collection|ProductVariantEntity[]
     */
    public function getVariants(): Collection 
    {
        return $this->variants;
    }

    /**
     * @param Collection|ProductVariantEntity[] $variants
     *
     * @return ProductEntity
     */
    public function setVariants(Collection $variants): ProductEntity 
    {
        $this->variants = $variants;
        return $this;
    }

    /**
     * @param Collection|ProductVariantEntity[] $variants
     *
     * @return ProductEntity
     */
    public function addVariants(Collection $variants): ProductEntity 
    {
        foreach ($variants as $variant) {
            $this->addVariant($variant);
        }
        return $this;
    }

    /**
     * @param ProductVariantEntity $variant
     *
     * @return ProductEntity
     */
    public function addVariant(ProductVariantEntity $variant
    ): ProductEntity 
    {
        if ($this->variants->contains($variant)) {
            return $this;
        }
        $variant->setProduct($this);
        $this->variants->add($variant);
        return $this;
    }

    /**
     * @param Collection|ProductVariantEntity[] $variants
     *
     * @return ProductEntity
     */
    public function removeVariants(Collection $variants): ProductEntity 
    {
        foreach ($variants as $variant) {
            $this->removeVariant($variant);
        }
        return $this;
    }

    /**
     * Remove single variant
     *
     * @param ProductVariantEntity $variant
     *
     * @return ProductEntity
     */
    public function removeVariant(ProductVariantEntity $variant
    ): ProductEntity 
    {
        $variant->setProduct(null);
        $this->variants->removeElement($variant);
        return $this;
    }


    /**
     * @return Collection|FeatureCombinationEntity[]
     */
    public function getFeatures(): Collection 
    {
        return $this->features;
    }

    /**
     * @param Collection|FeatureCombinationEntity[] $features
     *
     * @return ProductEntity
     */
    public function setFeatures(Collection $features): ProductEntity {
        $this->features = $features;
        return $this;
    }

    /**
     * @param Collection|FeatureCombinationEntity[] $features
     *
     * @return ProductEntity
     */
    public function addFeatures(Collection $features): ProductEntity {
        foreach ($features as $feature) {
            $this->addFeature($feature);
        }
        return $this;
    }

    /**
     * @param FeatureCombinationEntity $feature
     *
     * @return ProductEntity
     */
    public function addFeature(FeatureCombinationEntity $feature
    ): ProductEntity {
        if ($this->features->contains($feature)) {
            return $this;
        }
        $feature->setProduct($this);
        $this->features->add($feature);
        return $this;
    }

    /**
     * @param Collection|FeatureCombinationEntity[] $features
     *
     * @return ProductEntity
     */
    public function removeFeatures(Collection $features): ProductEntity {
        foreach ($features as $feature) {
            $this->removeFeature($feature);
        }
        return $this;
    }

    /**
     * Remove single feature
     *
     * @param FeatureCombinationEntity $feature
     *
     * @return ProductEntity
     */
    public function removeFeature(FeatureCombinationEntity $feature
    ): ProductEntity {
        $feature->setProduct(null);
        $this->features->removeElement($feature);
        return $this;
    }
}
