<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\ProductTemplate;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class ProductTemplateFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductTemplateEntity $productTemplatePrototype,
        ProductTemplateI18nEntity $productTemplateI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('product_template');

        $this->setHydrator($hydrator)
            ->setObject($productTemplatePrototype);

        $this->add(
            [
                'name'       => 'sort_order',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Sort Order'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'    => 'product_template_sort_order',
                    'value' => 0,
                ],
            ],
            ['priority' => 600]
        );


        $this->setAttribute('class', 'product-template-fieldset');
        $this->add(
            [
                'type'       => 'translatableCollection',
                'name'       => 'translations',
                'options'    => [
                    'allow_remove'   => true,
                    'target_element' => new ProductTemplateI18nFieldset(
                        $factory,
                        $hydrator,
                        $productTemplateI18nPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'product-template-i18n',
                ]
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'attributes',
                'type'       => 'catalogAttributesMultiCheckboxSelector',
                'options'    => [
                    'label'            => __('Attributes'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_product_template_attributes',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'features',
                'type'       => 'catalogFeaturesMultiCheckboxSelector',
                'options'    => [
                    'label'            => __('Features'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_product_template_features',
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
        if (!$object instanceof ProductTemplateEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductTemplateEntity'
            );
        }
        return parent::setObject($object);
    }
}
