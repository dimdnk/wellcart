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
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\FeatureValueI18nEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;

class FeatureValue extends AbstractEntity implements
    TranslatableEntity,
    FeatureValueEntity
{
    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var Collection|FeatureValueI18nEntity[]
     */
    protected $translations;

    /**
     * @var int
     */
    protected $sortOrder = 0;

    /**
     * @var FeatureEntity
     */
    protected $feature;

    /**
     * Perform a deep clone
     *
     * @return FeatureValueEntity
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
    }

    /**
     * @return Collection|FeatureValueI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|FeatureValueI18nEntity[] $translations
     *
     * @return FeatureValueEntity
     */
    public function setTranslations(Collection $translations
    ): FeatureValueEntity {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @param Collection|FeatureValueI18nEntity[] $translations
     *
     * @return FeatureValueEntity
     */
    public function addTranslations(Collection $translations
    ): FeatureValueEntity {
        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
        return $this;
    }

    /**
     * @param FeatureValueI18nEntity $translation
     *
     * @return FeatureValueEntity
     */
    public function addTranslation(FeatureValueI18nEntity $translation
    ): FeatureValueEntity {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setFeatureValue($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|FeatureValueI18nEntity[] $translations
     *
     * @return FeatureValueEntity
     */
    public function removeTranslations(Collection $translations
    ): FeatureValueEntity {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * Remove single related translation
     *
     * @param FeatureValueI18nEntity $translation
     *
     * @return FeatureValueEntity
     */
    public function removeTranslation(FeatureValueI18nEntity $translation
    ): FeatureValueEntity {
        $translation->setFeatureValue(null);
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
     * @return FeatureValueEntity
     */
    public function setId($id): FeatureValueEntity
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
     * @return FeatureValueEntity
     */
    public function setSortOrder($sortOrder): FeatureValueEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @return FeatureEntity
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param FeatureEntity $feature
     *
     * @return FeatureValueEntity
     */
    public function setFeature(FeatureEntity $feature = null
    ): FeatureValueEntity {
        $this->feature = $feature;
        return $this;
    }
}
