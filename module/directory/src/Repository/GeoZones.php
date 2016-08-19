<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Spec\GeoZoneRepository;
use WellCart\ORM\AbstractRepository;

class GeoZones extends AbstractRepository implements GeoZoneRepository
{

    /**
     * @return GeoZonesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('GeoZoneEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return GeoZonesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new GeoZonesQuery($this->_em))
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
    public function getZoneOptionsByCountry($country, $emptyOption = false)
    {
        return $this->getEntityManager()
            ->getRepository('WellCart\Directory\Spec\ZoneEntity')
            ->toOptionsList($country, $emptyOption);
    }
}
