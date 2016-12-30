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
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateI18nEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class ProductTemplate extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory                   $factory
     * @param ObjectHydrator            $hydrator
     * @param ProductTemplateEntity     $productTemplatePrototype
     * @param ProductTemplateI18nEntity $productTemplateI18nPrototype
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductTemplateEntity $productTemplatePrototype,
        ProductTemplateI18nEntity $productTemplateI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('catalog_product_template');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $productTemplateFieldset = new ProductTemplate\ProductTemplateFieldset(
            $factory,
            $hydrator,
            $productTemplatePrototype,
            $productTemplateI18nPrototype
        );
        $productTemplateFieldset->setUseAsBaseFieldset(true);
        $this->add($productTemplateFieldset, ['priority' => 700]);

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
            ->setLabel(__('Save & Continue Edit'))
            ->setOption('fontAwesome', ['icon' => 'check-circle']);
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->setValidationGroup(
            [
                'product_template' => [
                    'features',
                    'attributes',
                    'sort_order',
                    'translations' => [
                        'language',
                        'name',
                    ],
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
        if (!$object instanceof ProductTemplateEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductTemplateEntity'
            );
        }
        return parent::bind($object, $flags);
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

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $template = parent::getData($flag);

        if ($template instanceof ProductTemplateEntity) {
            $inputFilter = $this->getInputFilter();
            $raw = $inputFilter->getRawValues();

            if (empty($raw['product_template']['features'])) {
                $template->getFeatures()->clear();
            }
            if (empty($raw['product_template']['attributes'])) {
                $template->getAttributes()->clear();
            }
        }
        return $template;
    }
}
