<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Spec\CountryRepository;
use WellCart\ORM\AbstractRepository;

class Countries extends AbstractRepository implements CountryRepository
{

    /**
     * @return CountriesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('CountryEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return CountriesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new CountriesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        return $queryBuilder;
    }

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $companies = $this->findAll();
        foreach ($companies as $company) {
            $optionList[$company->getId()] = $company->getName();
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionsList')
        );

        return $optionList;
    }
}
