<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\PageView\Admin;

use WellCart\Admin\PageView\Form\Standard;
use WellCart\Directory\Exception;
use WellCart\Directory\Spec\CountryEntity;
use WellCart\Directory\Spec\CountryRepository;
use WellCart\ORM\Entity;

class CountryForm extends Standard
{
    public function __construct(
        CountryRepository $repository,
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

        $this->addLayoutHandle('directory/countries/form');
        $this->setPageTitle(__('Countries'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Countries'),
                        'route'  => 'zfcadmin/directory/countries',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('directory/countries/form/update');
            $this->setFormTitle(
                sprintf(__('Edit Country: %s'), e($entity->getName()))
            );
        } else {
            $this->addLayoutHandle('directory/countries/form/create');
            $this->setFormTitle(
                sprintf(__('Create Country %s'), e($entity->getName()))
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof CountryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CountryEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
