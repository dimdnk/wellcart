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
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureI18nEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;

class Feature extends AbstractEntity implements
    TranslatableEntity,
    FeatureEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var Collection|FeatureI18nEntity[]
     */
    protected $translations;

    /**
     * @var Collection|FeatureValueEntity[]
     */
    protected $values;

    /**
     * @var Collection|ProductTemplateEntity[]
     */
    protected $productTemplates;

    /**
     * @var int
     */
    protected $sortOrder = 0;

    /**
     * @var string
     */
    protected $backendName;

    /**
     * Perform a deep clone
     *
     * @return FeatureEntity
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
     * @return Collection|FeatureI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|FeatureI18nEntity[] $translations
     *
     * @return FeatureEntity
     */
    public function setTranslations(Collection $translations
    ): FeatureEntity {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @param Collection|FeatureI18nEntity[] $translations
     *
     * @return FeatureEntity
     */
    public function addTranslations(Collection $translations
    ): FeatureEntity {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }

        return $this;
    }

    /**
     * @param FeatureI18nEntity $translation
     *
     * @return FeatureEntity
     */
    public function addTranslation(FeatureI18nEntity $translation
    ): FeatureEntity {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setFeature($this);
        $this->translations->add($translation);

        return $this;
    }

    /**
     * @param Collection|FeatureI18nEntity[] $translations
     *
     * @return FeatureEntity
     */
    public function removeTranslations(Collection $translations
    ): FeatureEntity {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }

        return $this;
    }

    /**
     * Remove single related translation
     *
     * @param FeatureI18nEntity $translation
     *
     * @return FeatureEntity
     */
    public function removeTranslation(FeatureI18nEntity $translation
    ): FeatureEntity {
        $translation->setFeature(null);
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
     * @return FeatureEntity
     */
    public function setId($id): FeatureEntity
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
     * @return FeatureEntity
     */
    public function setSortOrder($sortOrder): FeatureEntity
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
    ): FeatureEntity {
        $this->values = $values;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addValues(Collection $values
    ): FeatureEntity {
        foreach ($values as $value) {
            $this->addValue($value);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addValue(FeatureValueEntity $value
    ): FeatureEntity {
        if ($this->values->contains($value)) {
            return $this;
        }

        $value->setFeature($this);
        $this->values->add($value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeValues(Collection $values
    ): FeatureEntity {
        foreach ($values as $value) {
            $this->removeValue($value);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeValue(FeatureValueEntity $value
    ): FeatureEntity {
        $value->setFeature(null);
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
     * @return Feature
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
    ): FeatureEntity {
        foreach ($productTemplates as $productTemplate) {
            $this->addProductTemplate($productTemplate);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addProductTemplate(ProductTemplateEntity $productTemplate
    ): FeatureEntity {
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
    ): FeatureEntity {
        foreach ($productTemplates as $productTemplate) {
            $this->removeProductTemplate($productTemplate);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeProductTemplate(ProductTemplateEntity $productTemplate
    ): FeatureEntity {
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
     * @return Feature
     */
    public function setBackendName($backendName)
    {
        $this->backendName = $backendName;

        return $this;
    }
}
