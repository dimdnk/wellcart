<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\ORM\QueryBuilder;

class ProductImagesQuery extends QueryBuilder
{
    public function base()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isBase = :is_base');
        $this->setParameter('is_base', true);
        return $this;
    }

    public function regular()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isBase = :is_base');
        $this->setParameter('is_base', false);
        return $this;
    }
}
