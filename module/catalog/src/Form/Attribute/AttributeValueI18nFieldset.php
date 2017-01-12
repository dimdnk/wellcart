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
use WellCart\Catalog\Spec\AttributeValueI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class AttributeValueI18nFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        AttributeValueI18nEntity $attributeI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('translations');
        $this->setHydrator($hydrator)
            ->setObject($attributeI18nPrototype);

        $this->setAttribute('class', 'attribute-value-name-fieldset');

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
                    'label' => __('Attribute Value Name'),
                ],
                'attributes' => [
                    'class' => 'form-control catalog_attribute_value_name',
                ],
            ],
            ['priority' => 700]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof AttributeValueI18nEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\AttributeValueI18nEntity'
            );
        }

        return parent::setObject($object);
    }
}
