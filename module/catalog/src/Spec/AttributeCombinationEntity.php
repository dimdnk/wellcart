<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

interface AttributeCombinationEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return AttributeCombinationEntity
     */
    public function __clone();

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AttributeCombinationEntity
     */
    public function setId($id): AttributeCombinationEntity;

    /**
     * @return string
     */
    public function getAttribute();

    /**
     * @param AttributeEntity $attribute
     *
     * @return AttributeCombinationEntity
     */
    public function setAttribute(AttributeEntity $attribute
    ): AttributeCombinationEntity;

    /**
     * @return AttributeValueEntity
     */
    public function getAttributeValue();

    /**
     * @param AttributeValueEntity $attributeValue
     *
     * @return AttributeCombinationEntity
     */
    public function setAttributeValue(AttributeValueEntity $attributeValue
    ): AttributeCombinationEntity;

    /**
     * @return ProductVariantEntity
     */
    public function getVariant();

    /**
     * @param ProductVariantEntity $variant
     *
     * @return AttributeCombinationEntity
     */
    public function setVariant(ProductVariantEntity $variant
    ): AttributeCombinationEntity;
}
