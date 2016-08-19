<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Form;

use WellCart\Directory\Exception;
use WellCart\Directory\Form\GeoZone\GeoZoneFieldset;
use WellCart\Directory\Spec\GeoZoneEntity;
use WellCart\Directory\Spec\GeoZoneMapEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class GeoZone extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory          $formFactory
     * @param ObjectHydrator   $hydrator
     * @param GeoZoneEntity    $geoZonePrototype
     * @param GeoZoneMapEntity $geoZoneMapPrototype
     */
    public function __construct(
        Factory $formFactory,
        ObjectHydrator $hydrator,
        GeoZoneEntity $geoZonePrototype,
        GeoZoneMapEntity $geoZoneMapPrototype
    ) {
        $this->setFormFactory($formFactory);
        parent::__construct('directory_geo_zone');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $geoZoneFieldset = new GeoZoneFieldset(
            $formFactory,
            $hydrator,
            $geoZonePrototype,
            $geoZoneMapPrototype
        );

        $geoZoneFieldset->setUseAsBaseFieldset(true);
        $this->add($geoZoneFieldset, ['priority' => 700]);

        $this->addToolbarButton(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save'),
                    'fontAwesome' => [
                        'icon' => 'check'
                    ],
                ],
                'attributes' => [
                    'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'))
            ->setOption('fontAwesome', ['icon' => 'check-circle']);
        $this->addToolbarButton($saveAndContinue, 120000);


        $this->setValidationGroup(
            [
                'geo_zone' => [
                    'name',
                    'description',
                    'geo_zone_maps' => [
                        'country',
                        'zone',
                    ],
                ],
            ]
        );


        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof GeoZoneEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\GeoZoneEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $geoZone = parent::getData($flag);
        if ($geoZone instanceof GeoZoneEntity) {
            $inputFilter = $this->getInputFilter();
            $raw = $inputFilter->getRawValues();
            if (empty($raw['geo_zone']['geo_zone_maps'])
            ) {
                $geoZone->getGeoZoneMaps()->clear();
            }
        }
        return $geoZone;
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
