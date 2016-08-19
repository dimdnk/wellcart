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

interface FeatureValueI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();


    /**
     * @return FeatureValueEntity
     */
    public function getFeatureValue();

    /**
     * @param FeatureValueEntity|null $option
     *
     * @return FeatureValueI18nEntity
     */
    public function setFeatureValue(FeatureValueEntity $option = null);

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return FeatureValueI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return FeatureValueI18nEntity
     */
    public function setId($id): FeatureValueI18nEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return FeatureValueI18nEntity
     */
    public function setName($name);

    /**
     * @return FeatureEntity
     */
    public function getFeature();

    /**
     * @param FeatureEntity $option
     *
     * @return FeatureValueI18nEntity
     */
    public function setFeature(FeatureEntity $option = null
    ): FeatureValueI18nEntity;
}
