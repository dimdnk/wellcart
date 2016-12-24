<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend;

use WellCart\Backend\PageView\Form\Standard;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateRepository;
use WellCart\ORM\Entity;

class ProductTemplateForm extends Standard
{
    public function __construct(
        ProductTemplateRepository $repository,
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

        $this->addLayoutHandle('catalog/product-templates/form');
        $this->setPageTitle(__('Product templates'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Product templates'),
                        'route'  => 'zfcadmin/catalog/product-templates',
                        'params' => [],
                    ],
                ]
            );

        $category = $this->getEntity();
        $translations = $category->getTranslations();


        if ($category->getId()) {
            $this->addLayoutHandle('catalog/product-templates/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit product template: %s'),
                    e($translations->current()->getName())
                )
            );
        } else {
            $this->addLayoutHandle('catalog/product-templates/form/create');
            $this->setFormTitle(__('Create new product template'));
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof ProductTemplateEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductTemplateEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
