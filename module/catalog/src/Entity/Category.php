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
use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\CategoryI18nEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Utility\Time;

class Category extends AbstractEntity
    implements TranslatableEntity, CategoryEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var Collection|CategoryI18nEntity[]
     */
    protected $translations;

    /**
     * @var Collection|ProductEntity[]
     */
    protected $products;

    /**
     * @var int
     */
    protected $lft;

    /**
     * @var int
     */
    protected $rgt;

    /**
     * @var int
     */
    protected $root;

    /**
     * @var int
     */
    protected $lvl;

    /**
     * @var Category
     */
    protected $parent;

    /**
     * @var Collection|CategoryEntity[]
     */
    protected $children;

    /**
     * @var bool
     */
    protected $isVisible = 1;

    /**
     * @var int
     */
    protected $sortOrder = 0;

    /**
     * @var string
     */
    protected $urlKey;

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
     * Perform a deep clone
     *
     * @return CategoryEntity
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
        $this->translations = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    /**
     * @return Collection|ProductEntity[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param Collection|ProductEntity[] $products
     *
     * @return CategoryEntity
     */
    public function setProducts(Collection $products): CategoryEntity
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return Collection|CategoryI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|CategoryI18nEntity[] $translations
     *
     * @return CategoryEntity
     */
    public function setTranslations(Collection $translations
    ): CategoryEntity {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @param Collection|CategoryI18nEntity[] $translations
     *
     * @return CategoryEntity
     */
    public function addTranslations(Collection $translations
    ): CategoryEntity {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
        return $this;
    }

    /**
     * @param CategoryI18nEntity $translation
     *
     * @return CategoryEntity
     */
    public function addTranslation(CategoryI18nEntity $translation
    ): CategoryEntity {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setCategory($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|CategoryI18nEntity[] $translations
     *
     * @return CategoryEntity
     */
    public function removeTranslations(Collection $translations
    ): CategoryEntity {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * Remove single related translation
     *
     * @param CategoryI18nEntity $translation
     *
     * @return CategoryEntity
     */
    public function removeTranslation(CategoryI18nEntity $translation
    ): CategoryEntity {
        $translation->setCategory(null);
        $this->translations->removeElement($translation);
        return $this;
    }

    /**
     * @return int
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * @param int $lft
     *
     * @return CategoryEntity
     */
    public function setLft($lft): CategoryEntity
    {
        $this->lft = $lft;
        return $this;
    }

    /**
     * @return int
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * @param int $rgt
     *
     * @return CategoryEntity
     */
    public function setRgt($rgt): CategoryEntity
    {
        $this->rgt = $rgt;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param int $root
     *
     * @return CategoryEntity
     */
    public function setRoot($root): CategoryEntity
    {
        $this->root = $root;
        return $this;
    }

    /**
     * @return int
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * @param int $lvl
     *
     * @return CategoryEntity
     */
    public function setLvl($lvl): CategoryEntity
    {
        $this->lvl = $lvl;
        return $this;
    }

    /**
     * @return CategoryEntity
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param CategoryEntity|null $parent
     *
     * @return CategoryEntity
     */
    public function setParent(CategoryEntity $parent = null)
    {
        $this->parent = $parent;
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
     * @return CategoryEntity
     */
    public function setId($id): CategoryEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return CategoryEntity
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Collection $children
     *
     * @return CategoryEntity
     */
    public function setChildren(Collection $children): CategoryEntity
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @param Collection $children
     *
     * @return CategoryEntity
     */
    public function addChildren(Collection $children): CategoryEntity
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }
        return $this;
    }

    /**
     * @param CategoryEntity $child
     *
     * @return CategoryEntity
     */
    public function addChild(CategoryEntity $child
    ): CategoryEntity {
        if ($this->children->contains($child)) {
            return $this;
        }

        $child->setParent($this);
        $this->children->add($child);
        return $this;
    }

    /**
     * @param Collection $children
     *
     * @return CategoryEntity
     */
    public function removeChildren(Collection $children
    ): CategoryEntity {
        foreach ($children as $child) {
            $this->removeChild($child);
        }
        return $this;
    }

    /**
     * @param CategoryEntity $child
     *
     * @return CategoryEntity
     */
    public function removeChild(CategoryEntity $child
    ): CategoryEntity {
        $child->setParent(null);
        $this->children->removeElement($child);
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return (bool)$this->isVisible;
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
     * @return CategoryEntity
     */
    public function setSortOrder($sortOrder): CategoryEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlKey()
    {
        return $this->urlKey;
    }

    /**
     * @param string $urlKey
     *
     * @return CategoryEntity
     */
    public function setUrlKey($urlKey): CategoryEntity
    {
        $this->urlKey = $urlKey;
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
     * @return CategoryEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
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
     * @param \DateTimeInterface $updatedAt
     *
     * @return CategoryEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param Collection $products
     *
     * @return CategoryEntity
     */
    public function addProducts(Collection $products): CategoryEntity
    {
        foreach ($products as $product) {
            $this->addProduct($product);
        }
        return $this;
    }

    /**
     * @param ProductEntity $product
     *
     * @return CategoryEntity
     */
    public function addProduct(ProductEntity $product
    ): CategoryEntity {
        if ($this->products->contains($product)) {
            return $this;
        }

        $product->getCategories()->add($this);
        $this->products->add($product);
        return $this;
    }

    /**
     * @param Collection $products
     *
     * @return CategoryEntity
     */
    public function removeProducts(Collection $products
    ): CategoryEntity {
        foreach ($products as $product) {
            $this->removeProduct($product);
        }
        return $this;
    }

    /**
     * @param ProductEntity $product
     *
     * @return CategoryEntity
     */
    public function removeProduct(ProductEntity $product
    ): CategoryEntity {
        $product->getCategories()->removeElement($this);
        $this->products->removeElement($product);
        return $this;
    }

    /**
     * @param boolean $isVisible
     *
     * @return CategoryEntity
     */
    public function setIsVisible($isVisible): CategoryEntity
    {
        $this->isVisible = $isVisible;
        return $this;
    }
}
