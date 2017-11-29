<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use WellCart\Base\Spec\LocaleLanguageEntity;

interface CategoryI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return string
     */
    public function getMetaTitle();

    /**
     * @return CategoryEntity
     */
    public function getCategory();

    /**
     * @param CategoryEntity|null $category
     *
     * @return CategoryI18nEntity
     */
    public function setCategory(CategoryEntity $category = null);

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage() :?LocaleLanguageEntity;

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return CategoryI18nEntity
     */
    public function setLanguage(?LocaleLanguageEntity $language);

    /**
     * @return int
     */
    public function getLanguageId();

    /**
     * @param $languageId
     *
     * @return CategoryI18nEntity
     */
    public function setLanguageId($languageId);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return CategoryI18nEntity
     */
    public function setId($id): CategoryI18nEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return CategoryI18nEntity
     */
    public function setName($name);

    /**
     * @param int $categoryId
     *
     * @return CategoryI18nEntity
     */
    public function setCategoryId($categoryId);

    /**
     * @param string $description
     *
     * @return CategoryI18nEntity
     */
    public function setDescription($description);

    /**
     * @param string $metaTitle
     *
     * @return CategoryI18nEntity
     */
    public function setMetaTitle($metaTitle);

    /**
     * @param string $metaKeywords
     *
     * @return CategoryI18nEntity
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * @param string $metaDescription
     *
     * @return CategoryI18nEntity
     */
    public function setMetaDescription($metaDescription);

    /**
     * @return int
     */
    public function getCategoryId();
}
