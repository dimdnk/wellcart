<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Spec\CountryEntity;
use WellCart\Directory\Spec\ZoneRepository;
use WellCart\ORM\AbstractRepository;

class Zones extends AbstractRepository implements ZoneRepository
{

    /**
     * @return ZonesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ZoneEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return ZonesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ZonesQuery($this->_em))
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
    public function toOptionsList($country, $emptyOption = false)
    {
        if ($country instanceof CountryEntity) {
            $country = $country->getId();
        }

        $optionList = ($emptyOption) ? ['' => __('-- All --')] : [];
        $zones = $this->findByCountry((int)$country);
        foreach ($zones as $zone) {
            $optionList[$zone->getId()] = $zone->getName();
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionsList')
        );
        return $optionList;
    }

    /**
     * Find by country id
     *
     * @param $id
     *
     * @return array
     */
    public function findByCountry($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );
        $zone = $this->findBy(['country' => $id]);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('id', 'zone')
        );
        return $zone;
    }

    /**
     * Get first country ID
     *
     * @return int
     * */
    public function getFirstCountryId()
    {
        return (int)$this->connection()
            ->fetchColumn(
                'SELECT country_id FROM directory_zones ORDER BY country_id ASC'
            );
    }
}
