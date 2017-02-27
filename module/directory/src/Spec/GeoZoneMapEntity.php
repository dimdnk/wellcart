<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Spec;

interface GeoZoneMapEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return int
     */
    public function getCountryId();

    /**
     * @param int $countryId
     *
     * @return GeoZoneMapEntity
     */
    public function setCountryId($countryId);

    /**
     * @return int
     */
    public function getZoneId();

    /**
     * @param int $zoneId
     *
     * @return GeoZoneMapEntity
     */
    public function setZoneId($zoneId);

    /**
     * @return int
     */
    public function getGeoZoneId();

    /**
     * @param int $geoZoneId
     *
     * @return GeoZoneMapEntity
     */
    public function setGeoZoneId($geoZoneId);

    /**
     * @return CountryEntity
     */
    public function getCountry();

    /**
     * @param CountryEntity $country
     *
     * @return GeoZoneMapEntity
     */
    public function setCountry(CountryEntity $country);

    /**
     * @return ZoneEntity
     */
    public function getZone();

    /**
     * @param ZoneEntity $zone
     *
     * @return GeoZoneMapEntity
     */
    public function setZone(ZoneEntity $zone);

    /**
     * @return GeoZoneEntity
     */
    public function getGeoZone();

    /**
     * @param GeoZoneEntity $geoZone
     *
     * @return GeoZoneMapEntity
     */
    public function setGeoZone(GeoZoneEntity $geoZone);

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return GeoZoneMapEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return GeoZoneMapEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     *
     * @return GeoZoneMapEntity
     */
    public function setId($id): GeoZoneMapEntity;
}
