<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\ORM\QueryBuilder;

class ProductTemplateI18nQuery extends QueryBuilder
{

    public function filterByLanguage(LocaleLanguageEntity $language)
    {
        $alias = $this->getRootAliases()[0];
        $this->andWhere($alias . '.language = :language');
        $this->setParameter('language', $language);

        return $this;
    }

    public function withProductTemplate()
    {
        $this->innerJoin(
            $this->getRootAliases()[0] . '.productTemplate', 'atr_set'
        );

        return $this;
    }
}
