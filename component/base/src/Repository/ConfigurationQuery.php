<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository;

use Doctrine\ORM\AbstractQuery;
use WellCart\ORM\QueryBuilder;

class ConfigurationQuery extends QueryBuilder
{

    /**
     * Get config value by key
     *
     * @param $key
     *
     * @return string
     */
    public function getValueByKey($key)
    {
        $alias = $this->getRootAliases()[0];
        $result = $this
            ->select($alias . '.configValue')
            ->where($alias . '.configKey = :config_key')
            ->setParameter('config_key', $key)
            ->getQuery()
            ->getOneOrNullResult(AbstractQuery::HYDRATE_SCALAR);
        return $result;
    }
}
