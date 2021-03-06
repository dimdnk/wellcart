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
use WellCart\Catalog\Spec\ProductI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class ProductI18nFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductI18nEntity $productTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('translations');
        $this->setHydrator($hydrator)
            ->setObject($productTranslationPrototype);
        $this->setAttribute('class', 'product-translation-fieldset');

        $this->add(
            [
                'name' => 'product_id',
                'type' => 'hidden',
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name' => 'language',
                'type' => 'hidden',
            ],
            ['priority' => 700]
        );


        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Product Name'),
                ],
                'attributes' => [
                    'class'    => 'form-control catalog_product_name',
                    'required' => 'required',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'description',
                'type'       => 'Textarea',
                'options'    => [
                    'label' => __('Description'),
                ],
                'attributes' => [
                    'rows' => 50,
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'    => 'meta_title',
                'type'    => 'Text',
                'options' => [
                    'label' => __('Page Title'),
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'    => 'meta_keywords',
                'type'    => 'Textarea',
                'options' => [
                    'label' => __('Meta Keywords')],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'    => 'meta_description',
                'type'    => 'Textarea',
                'options' => [
                    'label'      => __('Meta Description'),
                    'help-block' => __('Maximum 255 chars'),
                ],
            ],
            ['priority' => 500]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ProductI18nEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductI18nEntity'
            );
        }

        return parent::setObject($object);
    }
}
