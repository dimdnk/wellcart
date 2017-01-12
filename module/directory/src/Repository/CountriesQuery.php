<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Repository;

use WellCart\Directory\Spec\CountryEntity;
use WellCart\ORM\QueryBuilder;

class CountriesQuery extends QueryBuilder
{

    public function primary()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isPrimary = :is_primary')
            ->setParameter('is_primary', true)
            ->setMaxResults(1);

        return $this;
    }

    public function enabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', CountryEntity::STATUS_ENABLED);

        return $this;
    }

    public function disabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', CountryEntity::STATUS_DISABLED);

        return $this;
    }
}
