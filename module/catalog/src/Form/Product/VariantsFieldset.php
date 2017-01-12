<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Product;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\ProductVariantEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class VariantsFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductVariantEntity $productVariantPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('variants');
        $this->setHydrator($hydrator)
            ->setObject($productVariantPrototype);
        $this->setAttribute('class', 'row-fieldset product-variant-fieldset');

        $this->add(
            [
                'name' => 'product_id',
                'type' => 'hidden',
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'remove',
                'type'       => 'button',
                'options'    => [
                    'label' => ' ',

                ],
                'attributes' => [
                    'type'  => 'button',
                    'title' => __('Remove'),
                ],
            ],
            ['priority' => 700]
        );


        $this->add(
            [
                'name'    => 'quantity',
                'type'    => 'Text',
                'options' => [
                    'label' => __('Quantity'),
                ],
            ],
            ['priority' => 1300]
        );

        $this->add(
            [
                'name'       => 'price',
                'type'       => 'catalogProductPrice',
                'options'    => [
                    'label' => __('Price'),
                ],
                'attributes' => [
                    'required' => 'required',
                ],
            ],
            ['priority' => 1250]
        );


        $this->add(
            [
                'name'       => 'sku',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('SKU'),
                ],
                'attributes' => [
                    'required' => 'required',
                ],
            ],
            ['priority' => 1200]
        );


    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ProductVariantEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductVariantEntity'
            );
        }

        return parent::setObject($object);
    }
}
