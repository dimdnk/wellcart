<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Attribute;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\AttributeValueI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class AttributeValueFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        AttributeValueEntity $attributeValuePrototype,
        AttributeValueI18nEntity $attributeValueI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('attribute_value');

        $this->setHydrator($hydrator)
            ->setObject($attributeValuePrototype);
        $this->setAttribute('class', 'attribute-value-fieldset');


        $this->add(
            [
                'name'       => 'remove',
                'type'       => 'button',
                'options'    => [
                    'label' => ' ',

                ],
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'btn-remove-row btn btn-danger btn-xs',
                    'title' => __('Remove'),
                ],
            ],
            ['priority' => 800]
        );

        $this->add(
            [
                'type'       => 'translatableCollection',
                'name'       => 'translations',
                'options'    => [
                    'allow_remove'   => true,
                    'target_element' => new AttributeValueI18nFieldset(
                        $factory,
                        $hydrator,
                        $attributeValueI18nPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'attribute-value-i18n',
                ],
            ],
            ['priority' => 750]
        );


        $this->add(
            [
                'name'       => 'sort_order',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Sort Order'),

                ],
                'attributes' => [
                    'id'    => 'catalog_attribute_value_sort_order',
                    'value' => 0,
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
        if (!$object instanceof AttributeValueEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\AttributeValueEntity'
            );
        }

        return parent::setObject($object);
    }
}
