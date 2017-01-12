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
use WellCart\Directory\Spec\ZoneEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Zone extends AbstractEntity implements ZoneEntity
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
    protected $code;

    /**
     * @var Country
     */
    protected $country;

    /**
     * @var int
     */
    protected $countryId;

    /**
     * @var int
     */
    protected $status = ZoneEntity::STATUS_ENABLED;

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
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ($this->getStatus() == ZoneEntity::STATUS_ENABLED);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return ZoneEntity
     */
    public function setStatus($status): ZoneEntity
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return ($this->getStatus() == ZoneEntity::STATUS_DISABLED);
    }

    /**
     * @return CountryEntity
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param CountryEntity $country
     *
     * @return ZoneEntity
     */
    public function setCountry(CountryEntity $country
    ): ZoneEntity {
        $this->country = $country;
        $this->setCountryId($country->getId());

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return Zone
     */
    public function setCode($code): ZoneEntity
    {
        $this->code = $code;

        return $this;
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
     * @return Zone
     */
    public function setCountryId($countryId): ZoneEntity
    {
        $this->countryId = $countryId;

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
     * @return ZoneEntity
     */
    public function setId($id): ZoneEntity
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
     * @return ZoneEntity
     */
    public function setName($name): ZoneEntity
    {
        $this->name = $name;

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
     * @return ZoneEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ZoneEntity {
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
     * @return ZoneEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ZoneEntity {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
