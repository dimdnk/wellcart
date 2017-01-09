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
use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\CategoryI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Utility\Arr;
use Zend\Form\Factory;

class CategoryFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        CategoryEntity $categoryPrototype,
        CategoryI18nEntity $categoryTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('category');

        $this->setHydrator($hydrator)
            ->setObject($categoryPrototype);
        $this->setAttribute('class', 'category-fieldset');


        $this->add(
            [
                'name'       => 'parent',
                'type'       => 'catalogCategorySelector',
                'options'    => [
                    'label'            => __('Parent Category')
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_category_parent',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'is_visible',
                'type'       => 'Select',
                'options'    => [
                    'label'            => __('Visibility'),
                    'value_options'    => [
                        0 => __('Hidden'),
                        1 => __('Visible'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'catalog_category_is_visible',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'url_key',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('URL Key')
                ],
                'attributes' => [
                    'id'               => 'catalog_category_url_key',
                    'data-sluggable'   => 'true',
                    'data-slug-source' => '.catalog_category_name:first',
                    'required'         => 'required'
                ],
            ],
            ['priority' => 600]
        );


        $this->add(
            [
                'type'       => 'translatableCollection',
                'name'       => 'translations',
                'options'    => [
                    'allow_remove'   => true,
                    'target_element' => new CategoryI18nFieldset(
                        $factory,
                        $hydrator,
                        $categoryTranslationPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'category-translations',
                ]
            ],
            ['priority' => 550]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function populateValues($data)
    {
        parent::populateValues($data);
        $category = $this->getObject();
        $parentSelector = $this->iterator->get('parent');
        if ($category->getId()) {
            $valueFeatures = $parentSelector->getValueOptions();
            Arr::delete($valueFeatures, $category->getId());
            $parentSelector->setValueOptions($valueFeatures);
        }
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof CategoryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\CategoryEntity'
            );
        }
        return parent::setObject($object);
    }
}
