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
use WellCart\Catalog\Spec\ProductImageEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class ImagesFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductImageEntity $productImagePrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('images');
        $this->setHydrator($hydrator)
            ->setObject($productImagePrototype);
        $this->setAttribute('class', 'row-fieldset product-image-fieldset');

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
                'name'    => 'description',
                'type'    => 'Text',
                'options' => [
                    'label' => __('Alt Text'),
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'    => 'image',
                'type'    => 'catalogProductImage',
                'options' => [
                    'label' => __('Image File'),
                ],
            ],
            ['priority' => 600]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ProductImageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductImageEntity'
            );
        }

        if ($this->has('image')) {
            $this->get('image')
                ->setObject($object);
        }

        return parent::setObject($object);
    }
}
