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

interface ProductTemplateEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    public function __clone();

    /**
     * @return Collection|ProductTemplateI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|ProductTemplateI18nEntity[] $translations
     *
     * @return ProductTemplateEntity
     */
    public function setTranslations(Collection $translations
    ): ProductTemplateEntity;

    /**
     * @param Collection|ProductTemplateI18nEntity[] $translations
     *
     * @return ProductTemplateEntity
     */
    public function addTranslations(Collection $translations
    ): ProductTemplateEntity;

    /**
     * @param ProductTemplateI18nEntity $translation
     *
     * @return ProductTemplateEntity
     */
    public function addTranslation(ProductTemplateI18nEntity $translation
    ): ProductTemplateEntity;

    /**
     * @param Collection|ProductTemplateI18nEntity[] $translations
     *
     * @return ProductTemplateEntity
     */
    public function removeTranslations(Collection $translations
    ): ProductTemplateEntity;

    /**
     * Remove single related translation
     *
     * @param ProductTemplateI18nEntity $translation
     *
     * @return ProductTemplateEntity
     */
    public function removeTranslation(ProductTemplateI18nEntity $translation
    ): ProductTemplateEntity;


    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ProductTemplateEntity
     */
    public function setId($id): ProductTemplateEntity;


    /**
     * @param int $sortOrder
     *
     * @return ProductTemplateEntity
     */
    public function setSortOrder($sortOrder): ProductTemplateEntity;

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @return Collection|\WellCart\Catalog\Spec\FeatureEntity[]
     */
    public function getFeatures(): Collection;

    /**
     * @param Collection|\WellCart\Catalog\Spec\FeatureEntity[] $features
     *
     * @return ProductTemplateEntity
     */
    public function setFeatures(Collection $features);

    /**
     * @return Collection|\WellCart\Catalog\Spec\AttributeEntity[]
     */
    public function getAttributes(): Collection;

    /**
     * @param Collection|\WellCart\Catalog\Spec\AttributeEntity[] $attributes
     *
     * @return ProductTemplateEntity
     */
    public function setAttributes(Collection $attributes);


    /**
     * @inheritDoc
     */
    public function addAttributes(Collection $attributes
    ): ProductTemplateEntity;

    /**
     * @inheritDoc
     */
    public function addAttribute(AttributeEntity $attribute
    ): ProductTemplateEntity;

    /**
     * @inheritDoc
     */
    public function removeAttributes(Collection $attributes
    ): ProductTemplateEntity;

    /**
     * @inheritDoc
     */
    public function removeAttribute(AttributeEntity $attribute
    ): ProductTemplateEntity;


    /**
     * @inheritDoc
     */
    public function addFeatures(Collection $features
    ): ProductTemplateEntity;

    /**
     * @inheritDoc
     */
    public function addFeature(FeatureEntity $feature
    ): ProductTemplateEntity;

    /**
     * @inheritDoc
     */
    public function removeFeatures(Collection $features
    ): ProductTemplateEntity;

    /**
     * @inheritDoc
     */
    public function removeFeature(FeatureEntity $feature
    ): ProductTemplateEntity;

    /**
     * @return Collection|ProductEntity[]
     */
    public function getProducts();

    /**
     * @return boolean
     */
    public function isSystem(): bool;

    /**
     * @param boolean $isSystem
     *
     * @return ProductTemplateEntity
     */
    public function setIsSystem(bool $isSystem): ProductTemplateEntity;
}
