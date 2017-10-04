<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money\Service;

interface CurrencyListAwareInterface
{
    /**
     * Set Currency list to check allowed currencies against
     * @param  CurrencyList $list
     * @return self
     */
    public function setCurrencyList(CurrencyList $list);

}
