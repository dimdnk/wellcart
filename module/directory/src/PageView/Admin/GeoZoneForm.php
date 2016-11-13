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
use WellCart\Directory\Spec\GeoZoneEntity;
use WellCart\Directory\Spec\GeoZoneRepository;
use WellCart\ORM\Entity;

class GeoZoneForm extends Standard
{
    public function __construct(
        GeoZoneRepository $repository,
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

        $this->addLayoutHandle('directory/geo-zones/form');
        $this->configure();
        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof GeoZoneEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\GeoZoneEntity'
            );
        }
        return parent::setEntity($entity);
    }

    private function configure()
    {
        $this->setPageTitle(__('Geo Zones'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Geo Zones'),
                        'route'  => 'zfcadmin/directory/geo-zones',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('directory/geo-zones/form/update');
            $this->setFormTitle(
                sprintf(__('Edit Geo Zone: %s'), e($entity->getName()))
            );
        } else {
            $this->addLayoutHandle('directory/geo-zones/form/create');
            $this->setFormTitle(
                sprintf(__('Create Geo Zone %s'), e($entity->getName()))
            );
        }
    }
}
