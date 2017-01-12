<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Entity;

use Doctrine\Common\Collections\Collection;
use WellCart\Directory\Spec\GeoZoneEntity;
use WellCart\Directory\Spec\GeoZoneMapEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Utility\Time;

class GeoZone extends AbstractEntity implements GeoZoneEntity
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

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
     * @var Collection|GeoZoneMapEntity
     */
    protected $geoZoneMaps;

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
        $this->geoZoneMaps = new ArrayCollection();
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
     * @return GeoZoneEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): GeoZoneEntity {
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
     * @return GeoZoneEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): GeoZoneEntity {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return GeoZoneEntity
     */
    public function setDescription($description): GeoZoneEntity
    {
        $this->description = $description;

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
     * @param int $id
     *
     * @return GeoZoneEntity
     */
    public function setId($id): GeoZoneEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return GeoZoneEntity
     */
    public function setName($name): GeoZoneEntity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|GeoZoneMapEntity
     */
    public function getGeoZoneMaps(): Collection
    {
        return $this->geoZoneMaps;
    }

    /**
     * @param Collection|GeoZoneMapEntity[] $geoZoneMaps
     *
     * @return GeoZoneEntity
     */
    public function setGeoZoneMaps(Collection $geoZoneMaps)
    {
        $this->geoZoneMaps = $geoZoneMaps;

        return $this;
    }

    /**
     * @param Collection|GeoZoneMapEntity[] $geoZoneMaps
     *
     * @return GeoZoneEntity
     */
    public function addGeoZoneMaps(Collection $geoZoneMaps
    ): GeoZoneEntity {
        foreach ($geoZoneMaps as $geoZoneMap) {
            $this->addGeoZoneMap($geoZoneMap);
        }

        return $this;
    }

    /**
     * @param GeoZoneMapEntity $geoZoneMap
     *
     * @return GeoZoneEntity
     */
    public function addGeoZoneMap(GeoZoneMapEntity $geoZoneMap
    ): GeoZoneEntity {
        if ($this->geoZoneMaps->contains($geoZoneMap)) {
            return $this;
        }
        $geoZoneMap->setGeoZone($this);
        $this->geoZoneMaps->add($geoZoneMap);

        return $this;
    }

    /**
     * @param Collection|GeoZoneMapEntity[] $geoZoneMaps
     *
     * @return GeoZoneEntity
     */
    public function removeGeoZoneMaps(Collection $geoZoneMaps
    ): GeoZoneEntity {
        foreach ($geoZoneMaps as $geoZoneMap) {
            $this->removeGeoZoneMap($geoZoneMap);
        }

        return $this;
    }

    /**
     * Remove single map
     *
     * @param GeoZoneMapEntity $geoZoneMap
     *
     * @return GeoZoneEntity
     */
    public function removeGeoZoneMap(GeoZoneMapEntity $geoZoneMap
    ): GeoZoneEntity {
        //$geoZoneMap->setGeoZone(null);
        $this->geoZoneMaps->removeElement($geoZoneMap);

        return $this;
    }
}
