<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend;

use WellCart\Backend\PageView\Form\Standard;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductRepository;
use WellCart\ORM\Entity;

class ProductForm extends Standard
{
    public function __construct(
        ProductRepository $repository,
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
        $this->addLayoutHandle('catalog/products/form')
            ->setPageTitle(__('Products'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Products'),
                        'route'  => 'zfcadmin/catalog/products',
                        'params' => [],
                    ],
                ]
            );

        $product = $this->getEntity();
        $translations = $product->getTranslations();


        if ($product->getId()) {
            $this->addLayoutHandle('catalog/products/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit Product: %s'),
                    e($translations->current()->getName())
                )
            );
        } else {
            $this->addLayoutHandle('catalog/products/form/create');
            $this->setFormTitle(__('Create new Product'));
        }
        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof ProductEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductEntity'
            );
        }
        return parent::setEntity($entity);
    }
}
