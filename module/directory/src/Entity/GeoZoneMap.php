<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Entity;

use WellCart\Directory\Spec\CountryEntity;
use WellCart\Directory\Spec\GeoZoneEntity;
use WellCart\Directory\Spec\GeoZoneMapEntity;
use WellCart\Directory\Spec\ZoneEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class GeoZoneMap extends AbstractEntity implements GeoZoneMapEntity
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var CountryEntity
     */
    protected $country;

    /**
     * @var ZoneEntity
     */
    protected $zone;

    /**
     * @var GeoZoneEntity
     */
    protected $geoZone;

    /**
     * @var int
     */
    protected $countryId;

    /**
     * @var int
     */
    protected $zoneId;

    /**
     * @var int
     */
    protected $geoZoneId;

    /**
     * Created at
     *
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * Updated at
     *
     * @var \DateTimeInterface
     */
    protected $updatedAt;

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     *
     * @return GeoZoneMapEntity
     */
    public function setCountryId($countryId): GeoZoneMapEntity
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * @return int
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     *
     * @return GeoZoneMapEntity
     */
    public function setZoneId($zoneId): GeoZoneMapEntity
    {
        $this->zoneId = $zoneId;

        return $this;
    }

    /**
     * @return int
     */
    public function getGeoZoneId()
    {
        return $this->geoZoneId;
    }

    /**
     * @param int $geoZoneId
     *
     * @return GeoZoneMapEntity
     */
    public function setGeoZoneId($geoZoneId): GeoZoneMapEntity
    {
        $this->geoZoneId = $geoZoneId;

        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param CountryEntity $country
     *
     * @return GeoZoneMapEntity
     */
    public function setCountry(CountryEntity $country
    ): GeoZoneMapEntity {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param ZoneEntity $zone
     *
     * @return GeoZoneMapEntity
     */
    public function setZone(ZoneEntity $zone
    ): GeoZoneMapEntity {
        $this->zone = $zone;

        return $this;
    }

    /**
     * @return GeoZone
     */
    public function getGeoZone()
    {
        return $this->geoZone;
    }

    /**
     * @param GeoZoneEntity $geoZone
     *
     * @return GeoZoneMapEntity
     */
    public function setGeoZone(GeoZoneEntity $geoZone
    ): GeoZoneMapEntity {
        $this->geoZone = $geoZone;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return GeoZoneMapEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): GeoZoneMapEntity {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return GeoZoneMapEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): GeoZoneMapEntity {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return GeoZoneMapEntity
     */
    public function setId($id): GeoZoneMapEntity
    {
        $this->id = $id;

        return $this;
    }
}
