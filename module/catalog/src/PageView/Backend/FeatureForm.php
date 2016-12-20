<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend;

use WellCart\Admin\PageView\Form\Standard;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureRepository;
use WellCart\ORM\Entity;

class FeatureForm extends Standard
{
    public function __construct(
        FeatureRepository $repository,
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
        $this->addLayoutHandle('catalog/features/form');
        $this->setPageTitle(__('Features'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Features'),
                        'route'  => 'zfcadmin/catalog/features',
                        'params' => [],
                    ],
                ]
            );

        $category = $this->getEntity();
        $translations = $category->getTranslations();


        if ($category->getId()) {
            $this->addLayoutHandle('catalog/features/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit Feature: %s'),
                    e($translations->current()->getName())
                )
            );
        } else {
            $this->addLayoutHandle('catalog/features/form/create');
            $this->setFormTitle(__('Create new Feature'));
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof FeatureEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\FeatureEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
