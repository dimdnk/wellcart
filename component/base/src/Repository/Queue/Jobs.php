<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository\Queue;

use WellCart\Base\Spec\JobQueueRepository;
use WellCart\ORM\AbstractRepository;

class Jobs extends AbstractRepository implements JobQueueRepository
{

    /**
     * {@inheritDoc}
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('JobQueueEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * {@inheritDoc}
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new JobsQuery($this->_em))
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
