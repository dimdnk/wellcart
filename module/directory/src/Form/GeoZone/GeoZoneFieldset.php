<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Form\GeoZone;

use WellCart\Directory\Exception;
use WellCart\Directory\Spec\GeoZoneEntity;
use WellCart\Directory\Spec\GeoZoneMapEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class GeoZoneFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        GeoZoneEntity $geoZonePrototype,
        GeoZoneMapEntity $geoZoneMapPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('geo_zone');

        $this->setHydrator($hydrator)
            ->setObject($geoZonePrototype);

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Geo Zone Name'),
                ],
                'attributes' => [
                    'id' => 'directory_geo_zone_name',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'description',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Description'),
                ],
                'attributes' => [
                    'id' => 'directory_geo_zone_description',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'type'       => 'button',
                'name'       => 'add_new_geo_zone',
                'options'    => [
                    'label' => __('Create Geo Zone'),
                ],
                'attributes' => [
                    'id'               => 'directory_geo_zone_add_new_image',
                    'class'            => 'btn btn-default btn-create-new-row',
                    'data-source-path' => 'fieldset.geo-zone-maps',
                    'data-target-path' => 'tbody.table-fieldset-body',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'type'       => 'tableFieldsetCollection',
                'name'       => 'geo_zone_maps',
                'options'    => [
                    'count'                  => 0,
                    'should_create_template' => true,
                    'allow_add'              => true,
                    'target_element'         => new GeoZoneMapFieldset(
                        $factory,
                        $hydrator,
                        $geoZoneMapPrototype
                    ),
                    'columns'                => [
                        ['element_name' => 'country',
                         'label'        => __('Country'), 'width' => 40,],
                        ['element_name' => 'zone', 'label' => __('Zone'),
                         'width'        => 40,],
                    ],
                    'row_actions'            => [
                        ['element_name' => 'remove'],
                    ],
                ],
                'attributes' => [
                    'class' => 'geo-zone-maps',
                ],
            ],
            ['priority' => 550]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof GeoZoneEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\GeoZoneEntity'
            );
        }

        return parent::setObject($object);
    }
}
