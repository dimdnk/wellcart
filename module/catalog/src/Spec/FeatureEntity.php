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

interface FeatureEntity
{
    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return FeatureEntity
     */
    public function __clone();

    /**
     * @return Collection|FeatureI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|FeatureI18nEntity[] $translations
     *
     * @return FeatureEntity
     */
    public function setTranslations(Collection $translations
    ): FeatureEntity;

    /**
     * @param Collection|FeatureI18nEntity[] $translations
     *
     * @return FeatureEntity
     */
    public function addTranslations(Collection $translations
    ): FeatureEntity;

    /**
     * @param FeatureI18nEntity $translation
     *
     * @return FeatureEntity
     */
    public function addTranslation(FeatureI18nEntity $translation
    ): FeatureEntity;

    /**
     * @param Collection|FeatureI18nEntity[] $translations
     *
     * @return FeatureEntity
     */
    public function removeTranslations(Collection $translations
    ): FeatureEntity;

    /**
     * Remove single related translation
     *
     * @param FeatureI18nEntity $translation
     *
     * @return FeatureEntity
     */
    public function removeTranslation(FeatureI18nEntity $translation
    ): FeatureEntity;


    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return FeatureEntity
     */
    public function setId($id): FeatureEntity;


    /**
     * @param int $sortOrder
     *
     * @return FeatureEntity
     */
    public function setSortOrder($sortOrder): FeatureEntity;


    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @inheritDoc
     */
    public function getValues(): Collection;

    /**
     * @inheritDoc
     */
    public function setValues(Collection $values
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function addValues(Collection $values
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function addValue(FeatureValueEntity $value
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function removeValues(Collection $values
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function removeValue(FeatureValueEntity $value
    ): FeatureEntity;

    /**
     * @return Collection|\WellCart\Catalog\Spec\ProductTemplateEntity[]
     */
    public function getProductTemplates();

    /**
     * @param Collection|\WellCart\Catalog\Spec\ProductTemplateEntity[] $productTemplates
     *
     * @return Feature
     */
    public function setProductTemplates($productTemplates);

    /**
     * @inheritDoc
     */
    public function addProductTemplates(Collection $productTemplates
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function addProductTemplate(ProductTemplateEntity $productTemplate
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function removeProductTemplates(Collection $productTemplates
    ): FeatureEntity;

    /**
     * @inheritDoc
     */
    public function removeProductTemplate(ProductTemplateEntity $productTemplate
    ): FeatureEntity;


    public function getBackendName();

    public function setBackendName($backendName);
}
