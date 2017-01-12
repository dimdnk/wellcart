<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Spec;

interface CountryEntity
{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED  = 1;

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Determine is country enabled
     *
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
     * @return CountryEntity
     */
    public function setStatus($status): CountryEntity;

    /**
     * @return bool
     */
    public function isDisabled(): bool;

    /**
     * @return string
     */
    public function getAddressFormat();

    /**
     * @param string $addressFormat
     *
     * @return CountryEntity
     */
    public function setAddressFormat($addressFormat);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return CountryEntity
     */
    public function setId($id): CountryEntity;

    /**
     * @return string
     */
    public function getIsoCode2();

    /**
     * @param string $isoCode2
     *
     * @return CountryEntity
     */
    public function setIsoCode2($isoCode2);

    /**
     * @return string
     */
    public function getIsoCode3();

    /**
     * @param string $isoCode3
     *
     * @return CountryEntity
     */
    public function setIsoCode3($isoCode3);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return CountryEntity
     */
    public function setName($name);

    /**
     * @return bool
     */
    public function getPostcodeRequired();

    /**
     * @param boolean $postcodeRequired
     *
     * @return CountryEntity
     */
    public function setPostcodeRequired($postcodeRequired);

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return CountryEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return CountryEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null);
}
