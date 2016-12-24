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
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeRepository;
use WellCart\ORM\Entity;

class AttributeForm extends Standard
{

    public function __construct(
        AttributeRepository $repository,
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

        $this->addLayoutHandle('catalog/attributes/form');
        $this->setPageTitle(__('Attributes'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Attributes'),
                        'route'  => 'zfcadmin/catalog/attributes',
                        'params' => [],
                    ],
                ]
            );

        $category = $this->getEntity();
        $translations = $category->getTranslations();


        if ($category->getId()) {
            $this->addLayoutHandle('catalog/attributes/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit attribute: %s'),
                    e($translations->current()->getName())
                )
            );
        } else {
            $this->addLayoutHandle('catalog/attributes/form/create');
            $this->setFormTitle(__('Create new attribute'));
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof AttributeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\AttributeEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
