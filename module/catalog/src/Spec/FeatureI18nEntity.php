<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use WellCart\Base\Spec\LocaleLanguageEntity;

interface FeatureI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();


    /**
     * @return FeatureEntity
     */
    public function getFeature();

    /**
     * @param FeatureEntity|null $option
     *
     * @return FeatureI18nEntity
     */
    public function setFeature(FeatureEntity $option = null);

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return FeatureI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return FeatureI18nEntity
     */
    public function setId($id): FeatureI18nEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return FeatureI18nEntity
     */
    public function setName($name);

    public function getFeatureId();

    /**
     * @param int $optionId
     *
     * @return FeatureI18nEntity
     */
    public function setFeatureId($optionId): FeatureI18nEntity;
}
