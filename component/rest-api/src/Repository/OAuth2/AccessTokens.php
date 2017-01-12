<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Repository\OAuth2;

use WellCart\ORM\AbstractRepository;

class AccessTokens extends AbstractRepository
{

    /**
     * @return ClientsQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('AccessTokenEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return AccessTokensQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new AccessTokensQuery($this->_em))
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
