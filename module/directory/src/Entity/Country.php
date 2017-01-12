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
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Country extends AbstractEntity implements CountryEntity
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
     * @var bool
     */
    protected $postcodeRequired = false;

    /**
     * @var int
     */
    protected $status = CountryEntity::STATUS_ENABLED;

    /**
     * @var string
     */
    protected $addressFormat;

    /**
     * @var string
     */
    protected $isoCode2;

    /**
     * @var string
     */
    protected $isoCode3;

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

    public function isEnabled(): bool
    {
        return ($this->getStatus() == CountryEntity::STATUS_ENABLED);
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
     * @return CountryEntity
     */
    public function setStatus($status): CountryEntity
    {
        $this->status = $status;

        return $this;
    }

    public function isDisabled(): bool
    {
        return ($this->getStatus() == CountryEntity::STATUS_DISABLED);
    }

    /**
     * @return string
     */
    public function getAddressFormat()
    {
        return $this->addressFormat;
    }

    /**
     * @param string $addressFormat
     *
     * @return CountryEntity
     */
    public function setAddressFormat($addressFormat): CountryEntity
    {
        $this->addressFormat = $addressFormat;

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
     * @return CountryEntity
     */
    public function setId($id): CountryEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsoCode2()
    {
        return $this->isoCode2;
    }

    /**
     * @param string $isoCode2
     *
     * @return CountryEntity
     */
    public function setIsoCode2($isoCode2): CountryEntity
    {
        $this->isoCode2 = $isoCode2;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsoCode3()
    {
        return $this->isoCode3;
    }

    /**
     * @param string $isoCode3
     *
     * @return CountryEntity
     */
    public function setIsoCode3($isoCode3): CountryEntity
    {
        $this->isoCode3 = $isoCode3;

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
     * @return CountryEntity
     */
    public function setName($name): CountryEntity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPostcodeRequired(): bool
    {
        return $this->postcodeRequired;
    }

    /**
     * @param boolean $postcodeRequired
     *
     * @return CountryEntity
     */
    public function setPostcodeRequired($postcodeRequired
    ): CountryEntity {
        $this->postcodeRequired = (bool)$postcodeRequired;

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
     * @return CountryEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
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
     * @return CountryEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
