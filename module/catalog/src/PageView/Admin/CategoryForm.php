<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Admin;

use WellCart\Admin\PageView\Form\Standard;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\CategoryRepository;
use WellCart\ORM\Entity;

class CategoryForm extends Standard
{
    public function __construct(
        CategoryRepository $repository,
        $variables = null,
        $options = null
    ) {
        $this->setRepository($repository);
        parent::__construct($variables, $options);
    }

    /**
     * @inheritdoc
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }

        $this->addLayoutHandle('catalog/categories/form');
        $this->setPageTitle(__('Categories'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Categories'),
                        'route'  => 'zfcadmin/catalog/categories',
                        'params' => [],
                    ],
                ]
            );

        $category = $this->getEntity();
        $translations = $category->getTranslations();


        if ($category->getId()) {
            $this->addLayoutHandle('catalog/categories/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit Category: %s'),
                    e($translations->current()->getName())
                )
            );
        } else {
            $this->addLayoutHandle('catalog/categories/form/create');
            $this->setFormTitle(__('Create new Category'));
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof CategoryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\CategoryEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
