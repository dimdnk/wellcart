<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

interface FeatureCombinationEntity
{
    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Perform a deep clone
     *
     * @return FeatureCombinationEntity
     */
    public function __clone();

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return FeatureCombinationEntity
     */
    public function setId($id): FeatureCombinationEntity;

    /**
     * @return FeatureValueEntity
     */
    public function getFeature();

    /**
     * @param FeatureEntity $feature
     *
     * @return FeatureCombinationEntity
     */
    public function setFeature(FeatureEntity $feature
    ): FeatureCombinationEntity;

    /**
     * @return FeatureValueEntity
     */
    public function getFeatureValue();

    /**
     * @param FeatureValueEntity $featureValue
     *
     * @return FeatureCombinationEntity
     */
    public function setFeatureValue(FeatureValueEntity $featureValue = null
    ): FeatureCombinationEntity;

    /**
     * @return ProductEntity
     */
    public function getProduct();

    /**
     * @param ProductEntity $product
     *
     * @return FeatureCombinationEntity
     */
    public function setProduct(ProductEntity $product = null
    ): FeatureCombinationEntity;
}
