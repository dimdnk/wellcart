<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use Doctrine\Common\Collections\Collection;
use WellCart\Catalog\Spec\BrandEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Utility\Time;

class Brand extends AbstractEntity implements BrandEntity
{

    /**
     * @var int
     */
    protected $id;

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
     * @var Collection|ProductEntity[]
     */
    protected $products;

    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $imageFullPath;

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
        $this->setCreatedAt(new Time());
        $this->products = new ArrayCollection();
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
     * @return BrandEntity
     */
    public function setId($id): BrandEntity
    {
        $this->id = $id;
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
     * @return BrandEntity
     */
    public function setName($name): BrandEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Determine image availability
     *
     * @return bool
     */
    public function hasImage(): bool
    {
        return ($this->getImageFullPath() !== null);
    }

    /**
     * @return string
     */
    public function getImageFullPath()
    {
        return $this->imageFullPath;
    }

    /**
     * @param string $imageFullPath
     *
     * @return BrandEntity
     */
    public function setImageFullPath($imageFullPath): BrandEntity
    {
        $this->imageFullPath = $imageFullPath;
        return $this;
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
     * @return BrandEntity
     */
    public function setMetaTitle($metaTitle): BrandEntity
    {
        $this->metaTitle = $metaTitle;
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
     * @return BrandEntity
     */
    public function setMetaKeywords($metaKeywords): BrandEntity
    {
        $this->metaKeywords = $metaKeywords;
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
     * @return BrandEntity
     */
    public function setMetaDescription($metaDescription): BrandEntity
    {
        $this->metaDescription = $metaDescription;
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
     * @return BrandEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): BrandEntity
    {
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
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return BrandEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): BrandEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection|ProductEntity[]
     */
    public function getProducts(): Collection
    {
        $this->products || $this->products = new ArrayCollection();
        return $this->products;
    }

    /**
     * @param Collection|ProductEntity[] $products
     *
     * @return BrandEntity
     */
    public function setProducts(Collection $products): BrandEntity
    {
        $this->products = $products;
        return $this;
    }
}
