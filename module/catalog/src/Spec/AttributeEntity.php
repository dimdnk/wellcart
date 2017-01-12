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

interface AttributeEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return AttributeEntity
     */
    public function __clone();

    /**
     * @return Collection|AttributeI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|AttributeI18nEntity[] $translations
     *
     * @return AttributeEntity
     */
    public function setTranslations(Collection $translations
    ): AttributeEntity;

    /**
     * @param Collection|AttributeI18nEntity[] $translations
     *
     * @return AttributeEntity
     */
    public function addTranslations(Collection $translations
    ): AttributeEntity;

    /**
     * @param AttributeI18nEntity $translation
     *
     * @return AttributeEntity
     */
    public function addTranslation(AttributeI18nEntity $translation
    ): AttributeEntity;

    /**
     * @param Collection|AttributeI18nEntity[] $translations
     *
     * @return AttributeEntity
     */
    public function removeTranslations(Collection $translations
    ): AttributeEntity;

    /**
     * Remove single related translation
     *
     * @param AttributeI18nEntity $translation
     *
     * @return AttributeEntity
     */
    public function removeTranslation(AttributeI18nEntity $translation
    ): AttributeEntity;


    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AttributeEntity
     */
    public function setId($id): AttributeEntity;


    /**
     * @param int $sortOrder
     *
     * @return AttributeEntity
     */
    public function setSortOrder($sortOrder): AttributeEntity;

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
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function addValues(Collection $values
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function addValue(AttributeValueEntity $value
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function removeValues(Collection $values
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function removeValue(AttributeValueEntity $value
    ): AttributeEntity;

    /**
     * @return Collection|\WellCart\Catalog\Spec\ProductTemplateEntity[]
     */
    public function getProductTemplates();

    /**
     * @param Collection|\WellCart\Catalog\Spec\ProductTemplateEntity[] $productTemplates
     *
     * @return Attribute
     */
    public function setProductTemplates($productTemplates);

    /**
     * @inheritDoc
     */
    public function addProductTemplates(Collection $productTemplates
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function addProductTemplate(ProductTemplateEntity $productTemplate
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function removeProductTemplates(Collection $productTemplates
    ): AttributeEntity;

    /**
     * @inheritDoc
     */
    public function removeProductTemplate(ProductTemplateEntity $productTemplate
    ): AttributeEntity;

    /**
     * @return string
     */
    public function getBackendName();

    /**
     * @param string $backendName
     *
     * @return Attribute
     */
    public function setBackendName($backendName);
}
