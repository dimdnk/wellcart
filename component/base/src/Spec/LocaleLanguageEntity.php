<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Spec;

interface LocaleLanguageEntity
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
     * @return LocaleLanguageEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): LocaleLanguageEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return LocaleLanguageEntity
     */
    public function setId($id): LocaleLanguageEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return LocaleLanguageEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): LocaleLanguageEntity;

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
     * @return LocaleLanguageEntity
     */
    public function setCode($code): LocaleLanguageEntity;


    /**
     * @param boolean $isActive
     *
     * @return LocaleLanguageEntity
     */
    public function setIsActive(bool $isActive);

    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @return bool
     */
    public function isDefault(): bool;


    /**
     * @param boolean $isDefault
     *
     * @return LocaleLanguageEntity
     */
    public function setIsDefault(bool $isDefault);

    /**
     * @return string
     */
    public function getLocale();

    /**
     * @param string $locale
     *
     * @return LocaleLanguageEntity
     */
    public function setLocale($locale): LocaleLanguageEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return LocaleLanguageEntity
     */
    public function setName($name): LocaleLanguageEntity;

    /**
     * @return int
     */
    public function getSortOrder(): int;

    /**
     * @param int $sortOrder
     *
     * @return LocaleLanguageEntity
     */
    public function setSortOrder($sortOrder);

    /**
     * @return string
     */
    public function getTerritory();

    /**
     * @param string $territory
     *
     * @return LocaleLanguageEntity
     */
    public function setTerritory($territory);

    /**
     * @return bool
     */
    public function isSystem(): bool;

    /**
     * @param boolean $isSystem
     *
     * @return LocaleLanguageEntity
     */
    public function setIsSystem(bool $isSystem);
}
