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
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\AttributeValueI18nEntity;
use WellCart\ORM\AbstractEntity;

class AttributeValueI18n extends AbstractEntity
    implements AttributeValueI18nEntity
{

    /**
     * @var AttributeValueEntity
     */
    protected $attributeValue;

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
     * @var AttributeEntity
     */
    protected $attribute;


    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return AttributeValueEntity
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @inheritDoc
     */
    public function setAttributeValue(AttributeValueEntity $attributeValue = null
    ) {
        $this->attributeValue = $attributeValue;
        if ($attributeValue !== null) {
            $this->setAttribute($attributeValue->getAttribute());
        }

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
     * @return AttributeValueI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): AttributeValueI18nEntity {
        $this->language = $language;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->attributeValueId;
    }

    /**
     * @param int $id
     *
     * @return AttributeValueI18nEntity
     */
    public function setId($id): AttributeValueI18nEntity
    {
        $this->attributeValueId = $id;

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
     * @return AttributeValueI18nEntity
     */
    public function setName($name): AttributeValueI18nEntity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return AttributeEntity
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param AttributeEntity $attribute
     *
     * @return AttributeValueI18nEntity
     */
    public function setAttribute(AttributeEntity $attribute = null
    ): AttributeValueI18nEntity {
        $this->attribute = $attribute;

        return $this;
    }
}
