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

interface FeatureValueEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return FeatureValueEntity
     */
    public function __clone();

    /**
     * @return Collection|FeatureValueI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|FeatureValueI18nEntity[] $translations
     *
     * @return FeatureValueEntity
     */
    public function setTranslations(Collection $translations
    ): FeatureValueEntity;

    /**
     * @param Collection|FeatureValueI18nEntity[] $translations
     *
     * @return FeatureValueEntity
     */
    public function addTranslations(Collection $translations
    ): FeatureValueEntity;

    /**
     * @param FeatureValueI18nEntity $translation
     *
     * @return FeatureValueEntity
     */
    public function addTranslation(FeatureValueI18nEntity $translation
    ): FeatureValueEntity;

    /**
     * @param Collection|FeatureValueI18nEntity[] $translations
     *
     * @return FeatureValueEntity
     */
    public function removeTranslations(Collection $translations
    ): FeatureValueEntity;

    /**
     * Remove single related translation
     *
     * @param FeatureValueI18nEntity $translation
     *
     * @return FeatureValueEntity
     */
    public function removeTranslation(FeatureValueI18nEntity $translation
    ): FeatureValueEntity;


    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return FeatureValueEntity
     */
    public function setId($id): FeatureValueEntity;

    /**
     * @param int $sortOrder
     *
     * @return FeatureValueEntity
     */
    public function setSortOrder($sortOrder): FeatureValueEntity;

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @return FeatureEntity
     */
    public function getFeature();

    /**
     * @param FeatureEntity $feature
     *
     * @return FeatureValueEntity
     */
    public function setFeature(FeatureEntity $feature = null
    ): FeatureValueEntity;
}
