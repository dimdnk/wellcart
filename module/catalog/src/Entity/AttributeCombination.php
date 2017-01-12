<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Catalog\Spec\AttributeCombinationEntity;
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\ProductVariantEntity;
use WellCart\ORM\AbstractEntity;

class AttributeCombination
    extends AbstractEntity
    implements AttributeCombinationEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var AttributeEntity
     */
    protected $attribute;

    /**
     * @var AttributeValueEntity
     */
    protected $attributeValue;

    /**
     * @var ProductVariantEntity
     */
    protected $variant;

    /**
     * Perform a deep clone
     *
     * @return AttributeCombinationEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return AttributeCombinationEntity
     */
    public function setId($id): AttributeCombinationEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param AttributeEntity $attribute
     *
     * @return AttributeCombinationEntity
     */
    public function setAttribute(AttributeEntity $attribute
    ): AttributeCombinationEntity {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * @return AttributeValueEntity
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @param AttributeValueEntity $attributeValue
     *
     * @return AttributeCombinationEntity
     */
    public function setAttributeValue(AttributeValueEntity $attributeValue
    ): AttributeCombinationEntity {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    /**
     * @return ProductVariantEntity
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param ProductVariantEntity $variant
     *
     * @return AttributeCombinationEntity
     */
    public function setVariant(ProductVariantEntity $variant
    ): AttributeCombinationEntity {
        $this->variant = $variant;

        return $this;
    }
}
