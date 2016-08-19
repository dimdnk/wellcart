<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Repository;

use WellCart\CMS\Spec\PageEntity;
use WellCart\ORM\QueryBuilder;

class PagesQuery extends QueryBuilder
{
    public function visible()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', PageEntity::STATUS_VISIBLE);
        return $this;
    }

    public function hidden()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', PageEntity::STATUS_HIDDEN);
        return $this;
    }
}
