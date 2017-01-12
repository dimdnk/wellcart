<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Repository;

use WellCart\CMS\Spec\PageRepository;
use WellCart\ORM\AbstractRepository;

class Pages extends AbstractRepository implements PageRepository
{

    /**
     * @return PagesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('PageEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return PagesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new PagesQuery($this->_em))
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
