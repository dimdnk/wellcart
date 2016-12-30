<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\FeatureValueI18nEntity;
use WellCart\ORM\AbstractEntity;

class FeatureValueI18n extends AbstractEntity implements FeatureValueI18nEntity
{

    /**
     * @var FeatureValueEntity
     */
    protected $featureValue;

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
     * @var FeatureEntity
     */
    protected $feature;


    /**
     * Object constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @return FeatureValueEntity
     */
    public function getFeatureValue()
    {
        return $this->featureValue;
    }

    /**
     * @inheritDoc
     */
    public function setFeatureValue(FeatureValueEntity $featureValue = null
    ) {
        $this->featureValue = $featureValue;
        if ($featureValue !== null) {
            $this->setFeature($featureValue->getFeature());
        }

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
     * @return FeatureValueI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): FeatureValueI18nEntity {
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->featureValueId;
    }

    /**
     * @param int $id
     *
     * @return FeatureValueI18nEntity
     */
    public function setId($id): FeatureValueI18nEntity
    {
        $this->featureValueId = $id;
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
     * @return FeatureValueI18nEntity
     */
    public function setName($name): FeatureValueI18nEntity
    {
        $this->name = $name;
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
     * @return FeatureValueI18nEntity
     */
    public function setFeature(FeatureEntity $feature = null
    ): FeatureValueI18nEntity {
        $this->feature = $feature;
        return $this;
    }
}
