<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Form\GeoZone;

use WellCart\Directory\Exception;
use WellCart\Directory\Spec\GeoZoneMapEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class GeoZoneMapFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        GeoZoneMapEntity $geoZoneMapPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('geo_zone_maps');
        $this->setHydrator($hydrator)
            ->setObject($geoZoneMapPrototype);
        $this->setAttribute('class', 'geo-zone-map-fieldset');


        $this->add(
            [
                'name'       => 'country',
                'type'       => 'directoryCountrySelector',
                'options'    => [
                    'label' => __('Country'),
                ],
                'attributes' => [
                    'class' => 'country-selector',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'zone',
                'type'       => 'directoryZoneSelector',
                'options'    => [
                    'label' => __('Zone'),
                ],
                'attributes' => [
                    'class' => 'zone-selector',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'remove',
                'type'       => 'button',
                'options'    => [
                    'label' => ' ',
                ],
                'attributes' => [
                    'type'  => 'button',
                    'title' => __('Remove'),
                ],
            ],
            ['priority' => 600]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof GeoZoneMapEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\GeoZoneMapEntity'
            );
        }

        if ($object->getId()) {
            $this->get('zone')
                ->setCountry($object->getCountry());
        }

        return parent::setObject($object);
    }
}
