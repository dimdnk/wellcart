<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Spec;

interface ZoneEntity
{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED  = 1;

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param int $status
     *
     * @return ZoneEntity
     */
    public function setStatus($status): ZoneEntity;

    /**
     * @return bool
     */
    public function isDisabled(): bool;

    /**
     * @return CountryEntity
     */
    public function getCountry();

    /**
     * @param CountryEntity $country
     *
     * @return ZoneEntity
     */
    public function setCountry(CountryEntity $country);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
     * @return ZoneEntity
     */
    public function setCode($code): ZoneEntity;

    /**
     * @return int
     */
    public function getCountryId();

    /**
     * @param int $countryId
     *
     * @return ZoneEntity
     */
    public function setCountryId($countryId): ZoneEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ZoneEntity
     */
    public function setId($id): ZoneEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return ZoneEntity
     */
    public function setName($name): ZoneEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return ZoneEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ZoneEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return ZoneEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ZoneEntity;
}
