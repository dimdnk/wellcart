<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use Doctrine\Common\Collections\Collection;
use WellCart\Catalog\Spec\AttributeCombinationEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductVariantEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Utility\Time;

class ProductVariant
    extends AbstractEntity
    implements ProductVariantEntity
{
    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $quantity = 0;

    /**
     * SKU
     *
     * @var string
     */
    protected $sku;

    /**
     * @var double
     */
    protected $price;

    /**
     * @var int
     */
    protected $sortOrder = 0;


    /**
     * Created at
     *
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * Updated at
     *
     * @var \DateTimeInterface
     */
    protected $updatedAt;

    /**
     * @var ProductEntity
     */
    protected $product;

    /**
     * @var ArrayCollection
     */
    protected $combinations;

    /**
     * Perform a deep clone
     *
     * @return ProductVariantEntity
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
        $this->setCreatedAt(new Time());
        $this->combinations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return ProductVariantEntity
     */
    public function setQuantity($quantity): ProductVariantEntity
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     *
     * @return ProductVariantEntity
     */
    public function setSku($sku): ProductVariantEntity
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     *
     * @return ProductVariantEntity
     */
    public function setSortOrder($sortOrder): ProductVariantEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return ProductVariantEntity
     */
    public function setPrice($price): ProductVariantEntity
    {
        $this->price = doubleval($price);
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return ProductVariantEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ProductVariantEntity {
        $this->createdAt = $createdAt;
        return $this;
    }


    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return ProductEntity
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductEntity|null $product
     *
     * @return ProductVariantEntity
     */
    public function setProduct(ProductEntity $product = null
    ): ProductVariantEntity {
        $this->product = $product;
        return $this;
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
     * @return ProductVariantEntity
     */
    public function setId($id): ProductVariantEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Collection|AttributeCombinationEntity[]
     */
    public function getCombinations(): Collection
    {
        return $this->combinations;
    }

    /**
     * @param Collection|AttributeCombinationEntity[] $combinations
     *
     * @return ProductVariantEntity
     */
    public function setCombinations(Collection $combinations
    ): ProductVariantEntity {
        $this->combinations = $combinations;
        return $this;
    }

    /**
     * @param Collection|AttributeCombinationEntity[] $combinations
     *
     * @return ProductVariantEntity
     */
    public function addCombinations(Collection $combinations
    ): ProductVariantEntity {
        foreach ($combinations as $combination) {
            $this->addCombination($combination);
        }
        return $this;
    }

    /**
     * @param AttributeCombinationEntity $combination
     *
     * @return ProductVariantEntity
     */
    public function addCombination(AttributeCombinationEntity $combination
    ): ProductVariantEntity {
        if ($this->combinations->contains($combination)) {
            return $this;
        }

        $this->combinations->add($combination);
        return $this;
    }

    /**
     * @param Collection|AttributeCombinationEntity[] $combinations
     *
     * @return ProductVariantEntity
     */
    public function removeCombinations(Collection $combinations
    ): ProductVariantEntity {
        foreach ($combinations as $combination) {
            $this->removeCombination($combination);
        }
        return $this;
    }

    /**
     * Remove single combination
     *
     * @param AttributeCombinationEntity $combination
     *
     * @return ProductVariantEntity
     */
    public function removeCombination(AttributeCombinationEntity $combination
    ): ProductVariantEntity {
        $this->combinations->removeElement($combination);
        return $this;
    }

}
