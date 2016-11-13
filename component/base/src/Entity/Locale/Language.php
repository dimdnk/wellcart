<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Entity\Locale;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Language extends AbstractEntity implements LocaleLanguageEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * Locale Code
     *
     * @var string
     */
    protected $code;

    /**
     * Locale
     *
     * @var string
     */
    protected $locale;

    /**
     * Territory
     *
     * @var string
     */
    protected $territory;

    /**
     * Is internal language
     *
     * @var bool
     */
    protected $isSystem = false;

    /**
     * Is default locale
     *
     * @var bool
     */
    protected $isDefault = false;

    /**
     * Is active locale
     *
     * @var bool
     */
    protected $isActive = false;

    /**
     * Sort order
     *
     * @var int
     */
    protected $sortOrder = 1;

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
     * @inheritdoc
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): LocaleLanguageEntity {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id): LocaleLanguageEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): LocaleLanguageEntity {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function setCode($code): LocaleLanguageEntity
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @inheritdoc
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = (bool)$isActive;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @inheritdoc
     */
    public function setIsDefault(bool $isDefault)
    {
        $this->isDefault = (bool)$isDefault;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @inheritdoc
     */
    public function setLocale($locale): LocaleLanguageEntity
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name): LocaleLanguageEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    /**
     * @inheritdoc
     */
    public function setSortOrder($sortOrder): LocaleLanguageEntity
    {
        $this->sortOrder = abs((int)$sortOrder);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTerritory()
    {
        return $this->territory;
    }

    /**
     * @inheritdoc
     */
    public function setTerritory($territory): LocaleLanguageEntity
    {
        $this->territory = $territory;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isSystem(): bool
    {
        return $this->isSystem;
    }

    /**
     * @inheritdoc
     */
    public function setIsSystem(bool $isSystem)
    {
        $this->isSystem = (bool)$isSystem;
        return $this;
    }
}
