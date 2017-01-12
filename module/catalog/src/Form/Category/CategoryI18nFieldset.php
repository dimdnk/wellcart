<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Category;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\CategoryI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class CategoryI18nFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        CategoryI18nEntity $categoryTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('translations');
        $this->setHydrator($hydrator)
            ->setObject($categoryTranslationPrototype);

        $this->setAttribute('class', 'category-translation-fieldset');

        $this->add(
            [
                'name' => 'category_id',
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
                'name'    => 'name',
                'type'    => 'Text',
                'options' => [
                    'label' => __('Category Name'),
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'    => 'description',
                'type'    => 'Textarea',
                'options' => [
                    'label' => __('Description'),
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
                    'label' => __('Meta Keywords'),
                ],
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
        if (!$object instanceof CategoryI18nEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\CategoryI18nEntity'
            );
        }

        return parent::setObject($object);
    }
}
