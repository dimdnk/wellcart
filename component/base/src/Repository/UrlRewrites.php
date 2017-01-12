<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository;

use WellCart\Base\Spec\UrlRewriteEntity;
use WellCart\Base\Spec\UrlRewriteRepository;
use WellCart\ORM\AbstractRepository;

class UrlRewrites extends AbstractRepository implements UrlRewriteRepository
{

    /**
     * {@inheritDoc}
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('UrlRewriteEntity');
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
        $queryBuilder = (new UrlRewritesQuery($this->_em))
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
     * Find entity by request path
     *
     * @param $requestPath
     *
     * @return UrlRewriteEntity
     */
    public function findOneByRequestPath($requestPath)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('requestPath')
        );

        $urlRewrite = $this->findOneBy(['requestPath' => $requestPath]);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('requestPath', 'urlRewrite')
        );

        return $urlRewrite;
    }
}
