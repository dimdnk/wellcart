<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

interface ProductVariantEntity
{
    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return ProductVariantEntity
     */
    public function __clone();

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @param int $quantity
     *
     * @return ProductVariantEntity
     */
    public function setQuantity($quantity): ProductVariantEntity;


    /**
     * @return string
     */
    public function getSku();

    /**
     * @param string $sku
     *
     * @return ProductVariantEntity
     */
    public function setSku($sku): ProductVariantEntity;

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @param int $sortOrder
     *
     * @return ProductVariantEntity
     */
    public function setSortOrder($sortOrder): ProductVariantEntity;

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @param float $price
     *
     * @return ProductVariantEntity
     */
    public function setPrice($price): ProductVariantEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return ProductVariantEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ProductVariantEntity;


    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @return ProductEntity
     */
    public function getProduct();

    /**
     * @param ProductEntity|null $product
     *
     * @return ProductVariantEntity
     */
    public function setProduct(ProductEntity $product = null
    ): ProductVariantEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ProductVariantEntity
     */
    public function setId($id): ProductVariantEntity;
}
