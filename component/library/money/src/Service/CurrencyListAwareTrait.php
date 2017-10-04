<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money\Service;

trait CurrencyListAwareTrait
{
    /**
     * @var CurrencyList|NULL
     */
    protected $currencyList;

    /**
     * Set Currency list to check allowed currencies against
     * @param  CurrencyList $list
     * @return self
     */
    public function setCurrencyList(CurrencyList $list)
    {
        $this->currencyList = $list;

        return $this;
    }

    /**
     * Return the currency list for checking allowed currencies
     *
     * Lazy loads one if none set
     * @return CurrencyList
     */
    public function getCurrencyList()
    {
        if (!$this->currencyList) {
            $this->setCurrencyList(new CurrencyList);
        }

        return $this->currencyList;
    }

}
