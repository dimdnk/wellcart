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
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductI18nEntity;
use WellCart\ORM\AbstractEntity;

class ProductI18n extends AbstractEntity implements ProductI18nEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $productId;

    /**
     * @var int
     */
    protected $languageId;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var \WellCart\Base\Entity\Locale\Language
     */
    protected $language;

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
     * @return ProductI18nEntity
     */
    public function setMetaTitle($metaTitle): ProductI18nEntity
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductEntity|null $product
     *
     * @return ProductI18nEntity
     */
    public function setProduct(ProductEntity $product = null
    ): ProductI18nEntity
    {
        $productId = null;
        if ($product) {
            $productId = $product->getId();
        }

        $this->product = $product;
        $this->setProductId($productId);
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
     * @param int $languageId
     *
     * @return ProductI18nEntity
     */
    public function setLanguageId($languageId
    ): ProductI18nEntity
    {
        $this->languageId = $languageId;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->getId();
    }

    /**
     * @param int $productId
     *
     * @return ProductI18nEntity
     */
    public function setProductId($productId): ProductI18nEntity
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->productId;
    }

    /**
     * @param int $id
     *
     * @return Product
     */
    public function setId($id): ProductI18nEntity
    {
        $this->productId = $id;
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
     * @return ProductI18nEntity
     */
    public function setDescription($description
    ): ProductI18nEntity
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
     * @return ProductI18nEntity
     */
    public function setMetaDescription($metaDescription
    ): ProductI18nEntity
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
     * @return ProductI18nEntity
     */
    public function setMetaKeywords($metaKeywords
    ): ProductI18nEntity
    {
        $this->metaKeywords = $metaKeywords;
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
     * @return ProductI18nEntity
     */
    public function setName($name): ProductI18nEntity
    {
        $this->name = $name;
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
     * @return ProductI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): ProductI18nEntity
    {
        $this->language = $language;
        return $this;
    }
}
