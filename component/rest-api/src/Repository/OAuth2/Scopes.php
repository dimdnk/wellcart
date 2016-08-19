<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Repository\OAuth2;

use WellCart\ORM\AbstractRepository;
use WellCart\RestApi\Entity\OAuth2\Scope;
use WellCart\RestApi\Exception\DomainException;

class Scopes extends AbstractRepository
{

    /**
     * @return ScopesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ScopeEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return ScopesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ScopesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }

    public function ensureDefaultScope(Scope $scope)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('scope')
        );

        $isDefault = $scope->isDefault();
        if (!$isDefault) {
            $default = $this->findDefaultgetScope();
            if (is_null($default)) {
                throw new DomainException('Default scope not assigned.');
            }
        } else {
            $this->connection()->executeQuery(
                'UPDATE oauth2_scopes SET is_default = :is_default WHERE id != :id',
                ['is_default' => '0', 'id' => $scope->getId(),]
            );
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('scope')
        );
        return $scope;
    }

    /**
     * Find default scope
     *
     * @return null|Scope
     */
    public function findDefaultgetScope()
    {
        $scope = $this->findOneBy(['isDefault' => true]);
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('scope')
        );

        return $scope;
    }
}
