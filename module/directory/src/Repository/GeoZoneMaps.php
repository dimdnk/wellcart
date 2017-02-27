<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Spec\GeoZoneMapRepository;
use WellCart\ORM\AbstractRepository;

class GeoZoneMaps extends AbstractRepository implements GeoZoneMapRepository
{

    /**
     * @return GeoZoneMapsQuery
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
     * @return GeoZoneMapsQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new GeoZoneMapsQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );

        return $queryBuilder;
    }
}
