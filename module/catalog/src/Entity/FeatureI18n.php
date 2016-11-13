<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureI18nEntity;
use WellCart\ORM\AbstractEntity;

class FeatureI18n extends AbstractEntity implements FeatureI18nEntity
{

    /**
     * @var FeatureEntity
     */
    protected $feature;

    /**
     * @var \WellCart\Base\Spec\LocaleLanguageEntity
     */
    protected $language;
    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $featureId;


    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return FeatureEntity
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @inheritDoc
     */
    public function setFeature(FeatureEntity $feature = null)
    {
        $this->feature = $feature;
        return $this;
    }

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return FeatureI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): FeatureI18nEntity {
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->featureId;
    }

    /**
     * @param int $id
     *
     * @return FeatureI18nEntity
     */
    public function setId($id): FeatureI18nEntity
    {
        $this->featureId = $id;
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
     * @return FeatureI18nEntity
     */
    public function setName($name): FeatureI18nEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getFeatureId()
    {
        return $this->featureId;
    }

    /**
     * @param int $featureId
     *
     * @return FeatureI18nEntity
     */
    public function setFeatureId($featureId): FeatureI18nEntity
    {
        $this->featureId = $featureId;
        return $this;
    }
}
