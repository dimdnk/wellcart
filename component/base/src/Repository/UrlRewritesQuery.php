<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository;

use WellCart\ORM\QueryBuilder;

class UrlRewritesQuery extends QueryBuilder
{
    public function systemUrls()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', true);
        return $this;
    }

    public function manageableUrls()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', false);
        return $this;
    }
}
