<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository;

use WellCart\Base\Spec\ConfigurationRepository;
use WellCart\ORM\AbstractRepository;

class Configuration extends AbstractRepository
    implements ConfigurationRepository
{

    /**
     * @return ConfigurationQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ConfigurationEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return ConfigurationQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ConfigurationQuery($this->_em))
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
