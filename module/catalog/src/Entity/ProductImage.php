<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductImageEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class ProductImage extends AbstractEntity implements ProductImageEntity
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $fullPath;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $originalFilename;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $imageX;

    /**
     * @var int
     */
    protected $imageY;

    /**
     * @var bool
     */
    protected $isBase = false;

    /**
     * @var Product
     */
    protected $product;

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
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
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
     * @return ProductImageEntity
     */
    public function setProduct(ProductEntity $product = null
    ): ProductImageEntity {
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
     * @return ProductImageEntity
     */
    public function setId($id): ProductImageEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @param string $fullPath
     *
     * @return ProductImageEntity
     */
    public function setFullPath($fullPath): ProductImageEntity
    {
        $this->fullPath = $fullPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     *
     * @return ProductImageEntity
     */
    public function setFilename($filename): ProductImageEntity
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFilename()
    {
        return $this->originalFilename;
    }

    /**
     * @param string $originalFilename
     *
     * @return ProductImageEntity
     */
    public function setOriginalFilename($originalFilename
    ): ProductImageEntity {
        $this->originalFilename = $originalFilename;
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
     * @return ProductImageEntity
     */
    public function setDescription($description): ProductImageEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getImageX()
    {
        return $this->imageX;
    }

    /**
     * @param int $imageX
     *
     * @return ProductImageEntity
     */
    public function setImageX($imageX): ProductImageEntity
    {
        $this->imageX = $imageX;
        return $this;
    }

    /**
     * @return int
     */
    public function getImageY()
    {
        return $this->imageY;
    }

    /**
     * @param int $imageY
     *
     * @return ProductImageEntity
     */
    public function setImageY($imageY): ProductImageEntity
    {
        $this->imageY = $imageY;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBase(): bool
    {
        return (bool)$this->isBase;
    }

    /**
     * @param boolean $isBase
     *
     * @return ProductImageEntity
     */
    public function setIsBase($isBase)
    {
        $this->isBase = $isBase;
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
     * @return ProductImageEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ProductImageEntity {
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
     * @return ProductImageEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ProductImageEntity {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
