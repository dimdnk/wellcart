<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateI18nEntity;
use WellCart\ORM\AbstractEntity;

class ProductTemplateI18n extends AbstractEntity
    implements ProductTemplateI18nEntity
{

    /**
     * @var ProductTemplateEntity
     */
    protected $productTemplate;

    /**
     * @var int
     */
    protected $productTemplateId;

    /**
     * @var \WellCart\Base\Spec\LocaleLanguageEntity
     */
    protected $language;
    /**
     * Name
     *
     * @var string
     */
    protected $name;


    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return ProductTemplateEntity
     */
    public function getProductTemplate()
    {
        return $this->productTemplate;
    }

    /**
     * @inheritDoc
     */
    public function setProductTemplate(ProductTemplateEntity $productTemplate = null
    ) {
        $this->productTemplate = $productTemplate;
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
     * @return ProductTemplateI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): ProductTemplateI18nEntity {
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->productTemplateId;
    }

    /**
     * @param int $id
     *
     * @return ProductTemplateI18nEntity
     */
    public function setId($id): ProductTemplateI18nEntity
    {
        $this->productTemplateId = $id;
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
     * @return ProductTemplateI18nEntity
     */
    public function setName($name): ProductTemplateI18nEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductTemplateId()
    {
        return $this->productTemplateId;
    }

    /**
     * @param int $productTemplateId
     *
     * @return ProductTemplateI18n
     */
    public function setProductTemplateId($productTemplateId
    ): ProductTemplateI18nEntity {
        $this->productTemplateId = $productTemplateId;
        return $this;
    }
}
