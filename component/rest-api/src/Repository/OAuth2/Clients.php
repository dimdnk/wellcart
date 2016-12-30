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

class Clients extends AbstractRepository
{

    /**
     * @return ClientsQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ClientEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return ClientsQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ClientsQuery($this->_em))
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
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $clients = $this->findAll();
        foreach ($clients as $client) {
            $optionList[$client->getId()] = $client
                ->getUser()
                ->getDisplayName();
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionsList')
        );
        return $optionList;
    }
}
