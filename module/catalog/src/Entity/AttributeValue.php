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
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\AttributeValueI18nEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;

class AttributeValue extends AbstractEntity implements
    TranslatableEntity,
    AttributeValueEntity
{
    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var Collection|AttributeValueI18nEntity[]
     */
    protected $translations;

    /**
     * @var int
     */
    protected $sortOrder = 0;

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
        $this->translations = new ArrayCollection();
    }

    /**
     * Perform a deep clone
     *
     * @return AttributeValueEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * @return Collection|AttributeValueI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|AttributeValueI18nEntity[] $translations
     *
     * @return AttributeValueEntity
     */
    public function setTranslations(Collection $translations
    ): AttributeValueEntity {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @param Collection|AttributeValueI18nEntity[] $translations
     *
     * @return AttributeValueEntity
     */
    public function addTranslations(Collection $translations
    ): AttributeValueEntity {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
        return $this;
    }

    /**
     * @param AttributeValueI18nEntity $translation
     *
     * @return AttributeValueEntity
     */
    public function addTranslation(AttributeValueI18nEntity $translation
    ): AttributeValueEntity {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setAttributeValue($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|AttributeValueI18nEntity[] $translations
     *
     * @return AttributeValueEntity
     */
    public function removeTranslations(Collection $translations
    ): AttributeValueEntity {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * Remove single related translation
     *
     * @param AttributeValueI18nEntity $translation
     *
     * @return AttributeValueEntity
     */
    public function removeTranslation(AttributeValueI18nEntity $translation
    ): AttributeValueEntity {
        $translation->setAttributeValue(null);
        $this->translations->removeElement($translation);
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
     * @return AttributeValueEntity
     */
    public function setId($id): AttributeValueEntity
    {
        $this->id = $id;
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
     * @return AttributeValueEntity
     */
    public function setSortOrder($sortOrder): AttributeValueEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
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
     * @return AttributeValueEntity
     */
    public function setAttribute(AttributeEntity $attribute = null
    ): AttributeValueEntity {
        $this->attribute = $attribute;
        return $this;
    }
}
