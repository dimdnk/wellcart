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
use WellCart\Directory\Spec\ZoneEntity;
use WellCart\Directory\Spec\ZoneRepository;
use WellCart\ORM\Entity;

class ZoneForm extends Standard
{

    public function __construct(
        ZoneRepository $repository,
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

        $this->addLayoutHandle('directory/zones/form');
        $this->setPageTitle(__('Zones'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Zones'),
                        'route'  => 'zfcadmin/directory/zones',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('directory/zones/form/update');
            $this->setFormTitle(
                sprintf(__('Edit Zone: %s'), e($entity->getName()))
            );
        } else {
            $this->addLayoutHandle('directory/zones/form/create');
            $this->setFormTitle(
                sprintf(__('Create Zone %s'), e($entity->getName()))
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof ZoneEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\ZoneEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
