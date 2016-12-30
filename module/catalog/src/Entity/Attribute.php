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
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeI18nEntity;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;

class Attribute extends AbstractEntity implements
    TranslatableEntity,
    AttributeEntity
{
    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var Collection|AttributeI18nEntity[]
     */
    protected $translations;

    /**
     * @var Collection|AttributeValueEntity[]
     */
    protected $values;

    /**
     * @var int
     */
    protected $sortOrder = 0;

    /**
     * @var string
     */
    protected $backendName;

    /**
     * @var Collection|ProductTemplateEntity[]
     */
    protected $productTemplates;

    /**
     * Perform a deep clone
     *
     * @return AttributeEntity
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
        $this->translations = new ArrayCollection();
        $this->values = new ArrayCollection();
        $this->productTemplates = new ArrayCollection();
    }

    /**
     * @return Collection|AttributeI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|AttributeI18nEntity[] $translations
     *
     * @return AttributeEntity
     */
    public function setTranslations(Collection $translations
    ): AttributeEntity {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @param Collection|AttributeI18nEntity[] $translations
     *
     * @return AttributeEntity
     */
    public function addTranslations(Collection $translations
    ): AttributeEntity {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
        return $this;
    }

    /**
     * @param AttributeI18nEntity $translation
     *
     * @return AttributeEntity
     */
    public function addTranslation(AttributeI18nEntity $translation
    ): AttributeEntity {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setAttribute($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|AttributeI18nEntity[] $translations
     *
     * @return AttributeEntity
     */
    public function removeTranslations(Collection $translations
    ): AttributeEntity {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * Remove single related translation
     *
     * @param AttributeI18nEntity $translation
     *
     * @return AttributeEntity
     */
    public function removeTranslation(AttributeI18nEntity $translation
    ): AttributeEntity {
        $translation->setAttribute(null);
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
     * @return AttributeEntity
     */
    public function setId($id): AttributeEntity
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
     * @return AttributeEntity
     */
    public function setSortOrder($sortOrder): AttributeEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * @inheritDoc
     */
    public function setValues(Collection $values
    ): AttributeEntity {
        $this->values = $values;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addValues(Collection $values
    ): AttributeEntity {
        foreach ($values as $value) {
            $this->addValue($value);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addValue(AttributeValueEntity $value
    ): AttributeEntity {
        if ($this->values->contains($value)) {
            return $this;
        }

        $value->setAttribute($this);
        $this->values->add($value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeValues(Collection $values
    ): AttributeEntity {
        foreach ($values as $value) {
            $this->removeValue($value);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeValue(AttributeValueEntity $value
    ): AttributeEntity {
        $value->setAttribute(null);
        $this->values->removeElement($value);
        return $this;
    }

    /**
     * @return Collection|\WellCart\Catalog\Spec\ProductTemplateEntity[]
     */
    public function getProductTemplates()
    {
        return $this->productTemplates;
    }

    /**
     * @param Collection|\WellCart\Catalog\Spec\ProductTemplateEntity[] $productTemplates
     *
     * @return Attribute
     */
    public function setProductTemplates($productTemplates)
    {
        $this->productTemplates = $productTemplates;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addProductTemplates(Collection $productTemplates
    ): AttributeEntity {
        foreach ($productTemplates as $productTemplate) {
            $this->addProductTemplate($productTemplate);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addProductTemplate(ProductTemplateEntity $productTemplate
    ): AttributeEntity {
        if ($this->productTemplates->contains($productTemplate)) {
            return $this;
        }

        $this->productTemplates->add($productTemplate);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeProductTemplates(Collection $productTemplates
    ): AttributeEntity {
        foreach ($productTemplates as $productTemplate) {
            $this->removeProductTemplate($productTemplate);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeProductTemplate(ProductTemplateEntity $productTemplate
    ): AttributeEntity {
        $this->productTemplates->removeElement($productTemplate);
        return $this;
    }

    /**
     * @return string
     */
    public function getBackendName()
    {
        return $this->backendName;
    }

    /**
     * @param string $backendName
     *
     * @return Attribute
     */
    public function setBackendName($backendName)
    {
        $this->backendName = $backendName;
        return $this;
    }
}
