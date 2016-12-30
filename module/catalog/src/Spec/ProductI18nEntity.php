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

interface ProductI18nEntity
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
     * @return ProductEntity
     */
    public function getProduct();

    /**
     * @param ProductEntity|null $product
     *
     * @return ProductI18nEntity
     */
    public function setProduct(ProductEntity $product = null
    ): ProductI18nEntity;

    /**
     * @return int
     */
    public function getLanguageId();

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ProductI18nEntity
     */
    public function setId($id): ProductI18nEntity;

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
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return ProductI18nEntity
     */
    public function setName($name): ProductI18nEntity;

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return ProductI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): ProductI18nEntity;

    /**
     * @param int $productId
     *
     * @return ProductI18nEntity
     */
    public function setProductId($productId);

    /**
     * @param int $languageId
     *
     * @return ProductI18nEntity
     */
    public function setLanguageId($languageId
    ): ProductI18nEntity;

    /**
     * @param string $description
     *
     * @return ProductI18nEntity
     */
    public function setDescription($description
    ): ProductI18nEntity;

    /**
     * @param string $metaTitle
     *
     * @return ProductI18nEntity
     */
    public function setMetaTitle($metaTitle);

    /**
     * @param string $metaKeywords
     *
     * @return ProductI18nEntity
     */
    public function setMetaKeywords($metaKeywords
    ): ProductI18nEntity;

    /**
     * @param string $metaDescription
     *
     * @return ProductI18nEntity
     */
    public function setMetaDescription($metaDescription
    ): ProductI18nEntity;
}
