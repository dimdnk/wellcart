<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Repository;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\ORM\QueryBuilder;

class PageI18nQuery extends QueryBuilder
{

    public function filterByLanguage(LocaleLanguageEntity $language)
    {
        $alias = $this->getRootAliases()[0];
        $this->andWhere($alias . '.language = :language');
        $this->setParameter('language', $language);

        return $this;
    }

    public function withPage()
    {
        $this->innerJoin($this->getRootAliases()[0] . '.page', 'p');

        return $this;
    }
}
