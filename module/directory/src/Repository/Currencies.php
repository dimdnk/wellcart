<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Exception\DomainException;
use WellCart\Directory\Repository\Helper\CurrencyConverter;
use WellCart\Directory\Spec\CurrencyEntity;
use WellCart\Directory\Spec\CurrencyRepository;
use WellCart\ORM\AbstractRepository;

class Currencies extends AbstractRepository implements CurrencyRepository
{
    /**
     * @return CurrenciesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('CurrencyEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return CurrenciesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new CurrenciesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function ensurePrimaryCurrency(CurrencyEntity $currency)
    {

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('currency')
        );


        $isPrimary = $currency->isPrimary();
        if (!$isPrimary) {
            $default = $this->findPrimaryCurrency();
            if (is_null($default)) {
                throw new DomainException('Primary currency not assigned.');
            }
        } else {
            $this->connection()->executeQuery(
                'UPDATE directory_currencies SET is_primary = :is_primary WHERE currency_id != :id',
                ['is_primary' => '0', 'id' => $currency->getId()]
            );
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('currency')
        );

        return $currency;
    }

    /**
     * @inheritdoc
     */
    public function findPrimaryCurrency()
    {
        return $this->findOneBy(['isPrimary' => true]);
    }

    /**
     * @return array
     */
    public function performGroupUpdateRates(): array
    {
        $primary = $this->findPrimaryCurrency();
        $primaryCode = $primary->getCode();
        $result = [$primaryCode => $primary->getExchangeRate()];
        $list = $this->findBy(['isPrimary' => false]);
        set_time_limit(0);
        foreach ($list as $currency) {
            $currency = $this->updateSingleRate($currency, $primaryCode, false);
            $result[$currency->getCode()] = $currency->getExchangeRate();
        }
        ini_restore('max_execution_time');
        $this->getEntityManager()->flush();
        return $result;
    }

    /**
     * @param CurrencyEntity $currency
     * @param null           $primaryCode
     * @param bool           $flush
     *
     * @return CurrencyEntity
     */
    protected function updateSingleRate(
        CurrencyEntity $currency,
        $primaryCode = null,
        $flush = true
    ): CurrencyEntity {


        if ($primaryCode === null) {
            $primaryCode = $this->findPrimaryCurrency()->getCode();
        }
        $currencyCode = $currency->getCode();
        $rate = CurrencyConverter::convert($primaryCode, $currencyCode);
        if ($rate !== false) {
            $currency->setExchangeRate($rate);
            $this->_em->persist($currency);
            if ($flush) {
                $this->_em->flush($currency);
            }
        }
        return $currency;
    }
}
