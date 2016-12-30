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
use WellCart\Catalog\Spec\AttributeI18nEntity;
use WellCart\ORM\AbstractEntity;

class AttributeI18n extends AbstractEntity implements AttributeI18nEntity
{

    /**
     * @var AttributeEntity
     */
    protected $attribute;

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
     * @var int
     */
    protected $attributeId;


    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return AttributeEntity
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @inheritDoc
     */
    public function setAttribute(AttributeEntity $attribute = null)
    {
        $this->attribute = $attribute;
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
     * @return AttributeI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): AttributeI18nEntity {
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->attributeId;
    }

    /**
     * @param int $id
     *
     * @return AttributeI18nEntity
     */
    public function setId($id): AttributeI18nEntity
    {
        $this->attributeId = $id;
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
     * @return AttributeI18nEntity
     */
    public function setName($name): AttributeI18nEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getAttributeId()
    {
        return $this->attributeId;
    }

    /**
     * @param int $attributeId
     *
     * @return AttributeI18nEntity
     */
    public function setAttributeId($attributeId): AttributeI18nEntity
    {
        $this->attributeId = $attributeId;
        return $this;
    }
}
