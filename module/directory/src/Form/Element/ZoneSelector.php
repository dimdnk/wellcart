<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Form\Element;

use WellCart\Directory\Spec\CountryEntity;
use WellCart\Directory\Spec\ZoneRepository;
use WellCart\Form\Element\Select;

class ZoneSelector extends Select
{

    /**
     * @var ZoneRepository
     */
    protected $zones;

    /**
     * @param null                $name
     * @param array               $options
     * @param ZoneRepository|null $zoneRepository
     */
    public function __construct(
        $name = null,
        $options = [],
        ZoneRepository $zoneRepository = null
    ) {
        $this->zones = $zoneRepository;
        if ($zoneRepository) {
            $this->setCountry($zoneRepository->getFirstCountryId());
        }
        parent::__construct($name, $options);
    }

    /**
     * Set country
     *
     * @param $country
     *
     * @return ZoneSelector
     */
    public function setCountry($country)
    {
        if (!$this->zones) {
            return $this;
        }
        if ($country instanceof CountryEntity) {
            $country = $country->getId();
        }

        $countryId = (int)$country;
        $valueOptions = $this->zones->toOptionsList($countryId);
        $this->setEmptyOption(__('-- All --'));
        $this->setValueOptions($valueOptions);

        $this->disableValidator();

        return $this;
    }
}
