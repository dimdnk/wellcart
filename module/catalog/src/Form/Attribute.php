<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeI18nEntity;
use WellCart\Catalog\Spec\AttributeValueEntity;
use WellCart\Catalog\Spec\AttributeValueI18nEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Attribute extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ObjectHydrator $hydrator
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        AttributeEntity $attributePrototype,
        AttributeI18nEntity $attributeI18nPrototype,
        AttributeValueEntity $attributeValuePrototype,
        AttributeValueI18nEntity $attributeValueI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('catalog_attribute');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $attributeFieldset = new Attribute\AttributeFieldset(
            $factory,
            $hydrator,
            $attributePrototype,
            $attributeI18nPrototype,
            $attributeValuePrototype,
            $attributeValueI18nPrototype
        );

        $attributeFieldset->setUseAsBaseFieldset(true);
        $this->add($attributeFieldset, ['priority' => 700]);

        $this->addToolbarButton(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save'),
                    'fontAwesome' => [
                        'icon' => 'check'
                    ],
                ],
                'attributes' => [
                    'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'));
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->setValidationGroup(
            [
                'attribute' => [
                    'product_templates',
                    'backend_name',
                    'sort_order',
                    'translations' => [
                        'language',
                        'name',
                    ],
                    'values'       =>
                        [
                            'sort_order',
                            'translations' => [
                                'language',
                                'name',
                            ],
                        ]
                ],
            ]
        );

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof AttributeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\AttributeEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $attribute = parent::getData($flag);

        if ($attribute instanceof AttributeEntity) {
            $inputFilter = $this->getInputFilter();
            $raw = $inputFilter->getRawValues();

            if (empty($raw['attribute']['translations'])) {
                $attribute->getTranslations()->clear();
            }
            if (empty($raw['attribute']['values'])) {
                $attribute->getValues()->clear();
            }

            if (empty($raw['attribute']['product_templates'])) {
                $attribute->getProductTemplates()->clear();
            }

            foreach ($attribute->getValues() as $value) {
                /**
                 * @var $value AttributeValueEntity
                 */
                $value->setAttribute($attribute);
                foreach ($value->getTranslations() as $valueI18n) {
                    $valueI18n->setAttribute($attribute);
                }
            }
        }
        return $attribute;
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof AttributeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\AttributeEntity'
            );
        }
        return parent::setObject($object);
    }
}
