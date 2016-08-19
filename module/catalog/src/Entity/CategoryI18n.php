<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\CategoryI18nEntity;
use WellCart\ORM\AbstractEntity;

class CategoryI18n extends AbstractEntity implements CategoryI18nEntity
{

    /**
     * @var CategoryEntity
     */
    protected $category;

    /**
     * @var \WellCart\Base\Spec\LocaleLanguageEntity
     */
    protected $language;

    /**
     * ID
     *
     * @var int
     */
    protected $categoryId;

    /**
     * @var int
     */
    protected $languageId;

    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $metaTitle;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     *
     * @return CategoryI18nEntity
     */
    public function setMetaTitle($metaTitle): CategoryI18nEntity
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return CategoryEntity
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param CategoryEntity|null $category
     *
     * @return CategoryI18nEntity
     */
    public function setCategory(CategoryEntity $category = null
    ): CategoryI18nEntity
    {
        $categoryId = null;
        if ($category) {
            $categoryId = $category->getId();
        }

        $this->category = $category;
        $this->setCategoryId($categoryId);
        return $this;
    }

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return CategoryI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): CategoryI18nEntity
    {
        $languageId = null;
        if ($language) {
            $languageId = $language->getId();
        }

        $this->language = $language;
        $this->setLanguageId($languageId);
        return $this;
    }

    /**
     * @return int
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @param $languageId
     *
     * @return CategoryI18nEntity
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return CategoryI18nEntity
     */
    public function setDescription($description
    ): CategoryI18nEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     *
     * @return CategoryI18nEntity
     */
    public function setMetaDescription($metaDescription
    ): CategoryI18nEntity
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     *
     * @return CategoryI18nEntity
     */
    public function setMetaKeywords($metaKeywords
    ): CategoryI18nEntity
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $id
     *
     * @return CategoryI18nEntity
     */
    public function setId($id): CategoryI18nEntity
    {
        $this->categoryId = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return CategoryI18nEntity
     */
    public function setName($name): CategoryI18nEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     *
     * @return CategoryI18nEntity
     */
    public function setCategoryId($categoryId
    ): CategoryI18nEntity
    {
        $this->categoryId = $categoryId;
        return $this;
    }
}
