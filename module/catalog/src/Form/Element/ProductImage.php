<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Element;

use WellCart\Catalog\Spec\ProductImageEntity;
use Zend\Form\Element\File;

class ProductImage extends File
{

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes
        = [
            'type' => 'catalogProductImage',
        ];

    /**
     * @var ProductImageEntity
     */
    protected $object;

    /**
     * @return ProductImageEntity
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     *
     * @return ProductImageEntity
     */
    public function setObject(ProductImageEntity $object)
    {
        $this->object = $object;
        return $this;
    }
}
