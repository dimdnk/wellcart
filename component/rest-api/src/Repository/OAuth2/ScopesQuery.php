<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Repository\OAuth2;

use WellCart\ORM\QueryBuilder;

class ScopesQuery extends QueryBuilder
{
    public function defaultgetScope()
    {
        $this->andWhere(
            $this->getRootAliases()[0] . '.isDefault = :is_default'
        );
        $this->setParameter('is_default', 1);
        return $this;
    }
}
