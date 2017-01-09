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
use WellCart\Catalog\Spec\FeatureValueI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class FeatureValueI18nFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        FeatureValueI18nEntity $featureI18nPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('translations');
        $this->setHydrator($hydrator)
            ->setObject($featureI18nPrototype);

        $this->setAttribute('class', 'feature-value-name-fieldset');

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
                    'label'            => __('Feature Value Name')
                ],
                'attributes' => [
                    'class' => 'form-control catalog_feature_value_name',
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
        if (!$object instanceof FeatureValueI18nEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\FeatureValueI18nEntity'
            );
        }
        return parent::setObject($object);
    }
}
