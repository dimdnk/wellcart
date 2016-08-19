<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureI18nEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\FeatureValueI18nEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Feature extends AbstractForm
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
        FeatureEntity $featurePrototype,
        FeatureI18nEntity $featureI18nPrototype,
        FeatureValueEntity $featureValuePrototype,
        FeatureValueI18nEntity $featureValueI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('catalog_feature');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $featureFieldset = new Feature\FeatureFieldset(
            $factory,
            $hydrator,
            $featurePrototype,
            $featureI18nPrototype,
            $featureValuePrototype,
            $featureValueI18nPrototype
        );

        $featureFieldset->setUseAsBaseFieldset(true);
        $this->add($featureFieldset, ['priority' => 700]);

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
                'feature' => [
                    'backend_name',
                    'product_templates',
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
        if (!$object instanceof FeatureEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\FeatureEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $feature = parent::getData($flag);

        if ($feature instanceof FeatureEntity) {
            $inputFilter = $this->getInputFilter();
            $raw = $inputFilter->getRawValues();

            if (empty($raw['feature']['translations'])) {
                $feature->getTranslations()->clear();
            }
            if (empty($raw['feature']['values'])) {
                $feature->getValues()->clear();
            }

            if (empty($raw['feature']['product_templates'])) {
                $feature->getProductTemplates()->clear();
            }

            foreach ($feature->getValues() as $value) {
                /**
                 * @var $value FeatureValueEntity
                 */
                $value->setFeature($feature);
                foreach ($value->getTranslations() as $valueI18n) {
                    $valueI18n->setFeature($feature);
                }
            }
        }
        return $feature;
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof FeatureEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\FeatureEntity'
            );
        }
        return parent::setObject($object);
    }
}
