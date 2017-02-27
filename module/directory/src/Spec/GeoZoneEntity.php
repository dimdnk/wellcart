<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Spec;

use Doctrine\Common\Collections\Collection;

interface GeoZoneEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return GeoZoneEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return GeoZoneEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return GeoZoneEntity
     */
    public function setDescription($description);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return GeoZoneEntity
     */
    public function setId($id): GeoZoneEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return GeoZoneEntity
     */
    public function setName($name);

    /**
     * @param Collection|GeoZoneMapEntity[] $geoZoneMaps
     *
     * @return GeoZoneEntity
     */
    public function setGeoZoneMaps(Collection $geoZoneMaps);

    /**
     * @return Collection|GeoZoneMapEntity
     */
    public function getGeoZoneMaps(): Collection;

    /**
     * @param Collection|GeoZoneMapEntity[] $geoZoneMaps
     *
     * @return GeoZoneEntity
     */
    public function addGeoZoneMaps(Collection $geoZoneMaps
    ): GeoZoneEntity;

    /**
     * @param GeoZoneMapEntity $geoZoneMap
     *
     * @return GeoZoneEntity
     */
    public function addGeoZoneMap(GeoZoneMapEntity $geoZoneMap
    ): GeoZoneEntity;

    /**
     * @param Collection|GeoZoneMapEntity[] $geoZoneMaps
     *
     * @return GeoZoneEntity
     */
    public function removeGeoZoneMaps(Collection $geoZoneMaps
    ): GeoZoneEntity;

    /**
     * Remove single map
     *
     * @param GeoZoneMapEntity $geoZoneMap
     *
     * @return GeoZoneEntity
     */
    public function removeGeoZoneMap(GeoZoneMapEntity $geoZoneMap
    ): GeoZoneEntity;
}
