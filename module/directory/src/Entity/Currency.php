<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Entity;

use WellCart\Directory\Spec\CurrencyEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Currency extends AbstractEntity implements CurrencyEntity
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * @var string
     */
    protected $symbolPosition = CurrencyEntity::POSITION_RIGHT;

    /**
     * @var double
     */
    protected $exchangeRate = 1.0;

    /**
     * @var int
     */
    protected $decimals = 2;

    /**
     * @var string
     */
    protected $decimalsSeparator;

    /**
     * @var string
     */
    protected $thousandsSeparator;

    /**
     * @var int
     */
    protected $status = CurrencyEntity::STATUS_DISABLED;

    /**
     * @var bool
     */
    protected $isPrimary = false;

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
     * @param boolean $isPrimary
     *
     * @return CurrencyEntity
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ($this->getStatus() == CurrencyEntity::STATUS_ENABLED);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return CurrencyEntity
     */
    public function setStatus($status): CurrencyEntity
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return ($this->getStatus() == CurrencyEntity::STATUS_DISABLED);
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
     * @return CurrencyEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): CurrencyEntity {
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
     * @return CurrencyEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): CurrencyEntity {
        $this->updatedAt = $updatedAt;

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
     * @return CurrencyEntity
     */
    public function setCode($code): CurrencyEntity
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return int
     */
    public function getDecimals(): int
    {
        return $this->decimals;
    }

    /**
     * @param int $decimals
     *
     * @return CurrencyEntity
     */
    public function setDecimals($decimals): CurrencyEntity
    {
        $this->decimals = $decimals;

        return $this;
    }

    /**
     * @return string
     */
    public function getDecimalsSeparator()
    {
        return $this->decimalsSeparator;
    }

    /**
     * @param string $decimalsSeparator
     *
     * @return CurrencyEntity
     */
    public function setDecimalsSeparator($decimalsSeparator
    ): CurrencyEntity {
        $this->decimalsSeparator = $decimalsSeparator;

        return $this;
    }

    /**
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param float $exchangeRate
     *
     * @return CurrencyEntity
     */
    public function setExchangeRate($exchangeRate): CurrencyEntity
    {
        if ($this->isPrimary()) {
            $exchangeRate = 1;
        }
        $this->exchangeRate = (double)$exchangeRate;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPrimary(): bool
    {
        return boolval($this->isPrimary);
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
     * @return CurrencyEntity
     */
    public function setId($id): CurrencyEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     *
     * @return CurrencyEntity
     */
    public function setSymbol($symbol): CurrencyEntity
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * @return string
     */
    public function getSymbolPosition()
    {
        return $this->symbolPosition;
    }

    /**
     * @param string $symbolPosition
     *
     * @return CurrencyEntity
     */
    public function setSymbolPosition($symbolPosition): CurrencyEntity
    {
        $this->symbolPosition = $symbolPosition;

        return $this;
    }

    /**
     * @return string
     */
    public function getThousandsSeparator()
    {
        return $this->thousandsSeparator;
    }

    /**
     * @param string $thousandsSeparator
     *
     * @return CurrencyEntity
     */
    public function setThousandsSeparator($thousandsSeparator
    ): CurrencyEntity {
        $this->thousandsSeparator = $thousandsSeparator;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return CurrencyEntity
     */
    public function setTitle($title): CurrencyEntity
    {
        $this->title = $title;

        return $this;
    }
}
