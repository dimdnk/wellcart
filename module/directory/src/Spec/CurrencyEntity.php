<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Spec;

interface CurrencyEntity
{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED  = 1;
    const POSITION_LEFT   = 'left';
    const POSITION_RIGHT  = 'right';

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return bool
     */
    public function isPrimary(): bool;

    /**
     * @param boolean $isPrimary
     *
     * @return CurrencyEntity
     */
    public function setIsPrimary($isPrimary);

    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     *
     * @return CurrencyEntity
     */
    public function setStatus($status): CurrencyEntity;

    /**
     * @return bool
     */
    public function isDisabled(): bool;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return CurrencyEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): CurrencyEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface|null $updatedAt
     *
     * @return CurrencyEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): CurrencyEntity;

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
     * @return CurrencyEntity
     */
    public function setCode($code): CurrencyEntity;

    /**
     * @return int
     */
    public function getDecimals(): int;

    /**
     * @param int $decimals
     *
     * @return CurrencyEntity
     */
    public function setDecimals($decimals): CurrencyEntity;

    /**
     * @return string
     */
    public function getDecimalsSeparator();

    /**
     * @param string $decimalsSeparator
     *
     * @return CurrencyEntity
     */
    public function setDecimalsSeparator($decimalsSeparator
    ): CurrencyEntity;

    /**
     * @return float
     */
    public function getExchangeRate();

    /**
     * @param float $exchangeRate
     *
     * @return CurrencyEntity
     */
    public function setExchangeRate($exchangeRate): CurrencyEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return CurrencyEntity
     */
    public function setId($id): CurrencyEntity;

    /**
     * @return string
     */
    public function getSymbol();

    /**
     * @param string $symbol
     *
     * @return CurrencyEntity
     */
    public function setSymbol($symbol): CurrencyEntity;

    /**
     * @return string
     */
    public function getSymbolPosition();

    /**
     * @param string $symbolPosition
     *
     * @return CurrencyEntity
     */
    public function setSymbolPosition($symbolPosition): CurrencyEntity;

    /**
     * @return string
     */
    public function getThousandsSeparator();

    /**
     * @param string $thousandsSeparator
     *
     * @return CurrencyEntity
     */
    public function setThousandsSeparator($thousandsSeparator
    ): CurrencyEntity;

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     *
     * @return CurrencyEntity
     */
    public function setTitle($title): CurrencyEntity;
}
