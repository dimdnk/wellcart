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
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateI18nEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;

class ProductTemplate extends AbstractEntity implements
    TranslatableEntity,
    ProductTemplateEntity
{
    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $isSystem = false;

    /**
     * @var Collection|ProductTemplateI18nEntity[]
     */
    protected $translations;

    /**
     * @var Collection|ProductEntity[]
     */
    protected $products;

    /**
     * @var Collection|FeatureEntity[]
     */
    protected $features;

    /**
     * @var Collection|AttributeEntity[]
     */
    protected $attributes;

    /**
     * @var int
     */
    protected $sortOrder = 0;

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->features = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * Perform a deep clone
     *
     * @return ProductTemplateEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * @return Collection|ProductTemplateI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|ProductTemplateI18nEntity[] $translations
     *
     * @return ProductTemplateEntity
     */
    public function setTranslations(Collection $translations
    ): ProductTemplateEntity {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @param Collection|ProductTemplateI18nEntity[] $translations
     *
     * @return ProductTemplateEntity
     */
    public function addTranslations(Collection $translations
    ): ProductTemplateEntity {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
        return $this;
    }

    /**
     * @param ProductTemplateI18nEntity $translation
     *
     * @return ProductTemplateEntity
     */
    public function addTranslation(ProductTemplateI18nEntity $translation
    ): ProductTemplateEntity {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setProductTemplate($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|ProductTemplateI18nEntity[] $translations
     *
     * @return ProductTemplateEntity
     */
    public function removeTranslations(Collection $translations
    ): ProductTemplateEntity {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * Remove single related translation
     *
     * @param ProductTemplateI18nEntity $translation
     *
     * @return ProductTemplateEntity
     */
    public function removeTranslation(ProductTemplateI18nEntity $translation
    ): ProductTemplateEntity {
        $translation->setProductTemplate(null);
        $this->translations->removeElement($translation);
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
     * @return ProductTemplateEntity
     */
    public function setId($id): ProductTemplateEntity
    {
        $this->id = $id;
        return $this;
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
     * @return ProductTemplateEntity
     */
    public function setSortOrder($sortOrder): ProductTemplateEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @return Collection|\WellCart\Catalog\Spec\FeatureEntity[]
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }

    /**
     * @param Collection|\WellCart\Catalog\Spec\FeatureEntity[] $features
     *
     * @return ProductTemplate
     */
    public function setFeatures(Collection $features)
    {
        $this->features = $features;
        return $this;
    }

    /**
     * @return Collection|\WellCart\Catalog\Spec\AttributeEntity[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @param Collection|\WellCart\Catalog\Spec\AttributeEntity[] $attributes
     *
     * @return ProductTemplate
     */
    public function setAttributes(Collection $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function addAttributes(Collection $attributes
    ): ProductTemplateEntity {
        foreach ($attributes as $attribute) {
            $this->addAttribute($attribute);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addAttribute(AttributeEntity $attribute
    ): ProductTemplateEntity {
        if ($this->attributes->contains($attribute)) {
            return $this;
        }

        $attribute->addProductTemplate($this);
        $this->attributes->add($attribute);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeAttributes(Collection $attributes
    ): ProductTemplateEntity {
        foreach ($attributes as $attribute) {
            $this->removeAttribute($attribute);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeAttribute(AttributeEntity $attribute
    ): ProductTemplateEntity {
        $attribute->removeProductTemplate($this);
        $this->attributes->removeElement($attribute);
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function addFeatures(Collection $features
    ): ProductTemplateEntity {
        foreach ($features as $feature) {
            $this->addFeature($feature);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFeature(FeatureEntity $feature
    ): ProductTemplateEntity {
        if ($this->features->contains($feature)) {
            return $this;
        }

        $feature->addProductTemplate($this);
        $this->features->add($feature);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeFeatures(Collection $features
    ): ProductTemplateEntity {
        foreach ($features as $feature) {
            $this->removeFeature($feature);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeFeature(FeatureEntity $feature
    ): ProductTemplateEntity {
        $feature->removeProductTemplate($this);
        $this->features->removeElement($feature);
        return $this;
    }

    /**
     * @return Collection|ProductEntity[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return boolean
     */
    public function isSystem(): bool
    {
        return (bool)$this->isSystem;
    }

    /**
     * @param boolean $isSystem
     *
     * @return ProductTemplateEntity
     */
    public function setIsSystem(bool $isSystem): ProductTemplateEntity
    {
        $this->isSystem = $isSystem;
        return $this;
    }
}
