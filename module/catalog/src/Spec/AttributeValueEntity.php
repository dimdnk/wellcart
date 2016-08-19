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

interface AttributeValueEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return AttributeValueEntity
     */
    public function __clone();

    /**
     * @return Collection|AttributeValueI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|AttributeValueI18nEntity[] $translations
     *
     * @return AttributeValueEntity
     */
    public function setTranslations(Collection $translations
    ): AttributeValueEntity;

    /**
     * @param Collection|AttributeValueI18nEntity[] $translations
     *
     * @return AttributeValueEntity
     */
    public function addTranslations(Collection $translations
    ): AttributeValueEntity;

    /**
     * @param AttributeValueI18nEntity $translation
     *
     * @return AttributeValueEntity
     */
    public function addTranslation(AttributeValueI18nEntity $translation
    ): AttributeValueEntity;

    /**
     * @param Collection|AttributeValueI18nEntity[] $translations
     *
     * @return AttributeValueEntity
     */
    public function removeTranslations(Collection $translations
    ): AttributeValueEntity;

    /**
     * Remove single related translation
     *
     * @param AttributeValueI18nEntity $translation
     *
     * @return AttributeValueEntity
     */
    public function removeTranslation(AttributeValueI18nEntity $translation
    ): AttributeValueEntity;


    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AttributeValueEntity
     */
    public function setId($id): AttributeValueEntity;

    /**
     * @param int $sortOrder
     *
     * @return AttributeValueEntity
     */
    public function setSortOrder($sortOrder): AttributeValueEntity;

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @return AttributeEntity
     */
    public function getAttribute();

    /**
     * @param AttributeEntity $attribute
     *
     * @return AttributeValueEntity
     */
    public function setAttribute(AttributeEntity $attribute = null
    ): AttributeValueEntity;
}
