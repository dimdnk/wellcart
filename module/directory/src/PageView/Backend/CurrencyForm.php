<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\PageView\Backend;

use WellCart\Backend\PageView\Form\Standard;
use WellCart\Directory\Exception;
use WellCart\Directory\Spec\CurrencyEntity;
use WellCart\Directory\Spec\CurrencyRepository;
use WellCart\ORM\Entity;

class CurrencyForm extends Standard
{
    public function __construct(
        CurrencyRepository $repository,
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

        $this->addLayoutHandle('directory/currencies/form');
        $this->setPageTitle(__('Currencies'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Currencies'),
                        'route'  => 'zfcadmin/directory/currencies',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('directory/currencies/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit currency settings: %s'),
                    e($entity->getTitle())
                )
            );
        } else {
            $this->addLayoutHandle('directory/currencies/form/create');
            $this->setFormTitle(
                sprintf(
                    __('Create currency settings %s'),
                    e($entity->getTitle())
                )
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof CurrencyEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CurrencyEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
