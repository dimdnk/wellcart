<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Spec\ZoneEntity;
use WellCart\ORM\QueryBuilder;

class ZonesQuery extends QueryBuilder
{
    public function enabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', ZoneEntity::STATUS_ENABLED);
        return $this;
    }

    public function disabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', ZoneEntity::STATUS_DISABLED);
        return $this;
    }
}
