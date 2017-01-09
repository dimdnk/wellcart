<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Feature;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\FeatureValueI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class FeatureValueFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        FeatureValueEntity $featureValuePrototype,
        FeatureValueI18nEntity $featureValueI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('feature_value');

        $this->setHydrator($hydrator)
            ->setObject($featureValuePrototype);
        $this->setAttribute('class', 'feature-value-fieldset');


        $this->add(
            [
                'name'       => 'remove',
                'type'       => 'button',
                'options'    => [
                    'label'            => ' ',
                    'label_attributes' => [
                        'class' => 'inline-label',
                    ],
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
                    'target_element' => new FeatureValueI18nFieldset(
                        $factory,
                        $hydrator,
                        $featureValueI18nPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'feature-value-i18n',
                ]
            ],
            ['priority' => 750]
        );


        $this->add(
            [
                'name'       => 'sort_order',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Sort Order'),
                ],
                'attributes' => [
                    'id'    => 'catalog_feature_value_sort_order',
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
        if (!$object instanceof FeatureValueEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\FeatureValueEntity'
            );
        }
        return parent::setObject($object);
    }
}
