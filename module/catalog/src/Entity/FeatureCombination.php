<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Entity;

use WellCart\Catalog\Spec\FeatureCombinationEntity;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\ORM\AbstractEntity;

class FeatureCombination
    extends AbstractEntity
    implements FeatureCombinationEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var FeatureEntity
     */
    protected $feature;

    /**
     * @var FeatureValueEntity
     */
    protected $featureValue;

    /**
     * @var ProductEntity
     */
    protected $product;

    /**
     * Perform a deep clone
     *
     * @return FeatureCombinationEntity
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
     * @return FeatureCombinationEntity
     */
    public function setId($id): FeatureCombinationEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param FeatureEntity $feature
     *
     * @return FeatureCombinationEntity
     */
    public function setFeature(FeatureEntity $feature
    ): FeatureCombinationEntity {
        $this->feature = $feature;

        return $this;
    }

    /**
     * @return FeatureValueEntity
     */
    public function getFeatureValue()
    {
        return $this->featureValue;
    }

    /**
     * @param FeatureValueEntity $featureValue
     *
     * @return FeatureCombinationEntity
     */
    public function setFeatureValue(FeatureValueEntity $featureValue = null
    ): FeatureCombinationEntity {
        $this->featureValue = $featureValue;

        return $this;
    }

    /**
     * @return ProductEntity
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductEntity $product
     *
     * @return FeatureCombinationEntity
     */
    public function setProduct(ProductEntity $product = null
    ): FeatureCombinationEntity {
        $this->product = $product;

        return $this;
    }
}