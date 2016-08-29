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
use WellCart\Catalog\Spec\BrandEntity;
use WellCart\Catalog\Spec\BrandRepository;
use WellCart\ORM\Entity;

class BrandForm extends Standard
{
    public function __construct(
        BrandRepository $repository,
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

        $this->addLayoutHandle('catalog/brands/form');
        $this->setPageTitle(__('Brands'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Brands'),
                        'route'  => 'zfcadmin/catalog/brands',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('catalog/brands/form/update');
            $this->setFormTitle(
                sprintf(__('Edit Brand: %s'), e($entity->getName()))
            );
        } else {
            $this->addLayoutHandle('catalog/brands/form/create');
            $this->setFormTitle(
                sprintf(__('Create Brand %s'), e($entity->getName()))
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof BrandEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\BrandEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
