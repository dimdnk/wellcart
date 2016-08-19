<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository\Locale;

use WellCart\ORM\QueryBuilder;

class LanguagesQuery extends QueryBuilder
{

    /**
     * Select active scope
     *
     * @return LanguagesQuery
     */
    public function active()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isActive = :is_active');
        $this->setParameter('is_active', true);
        return $this;
    }


    public function disabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isActive = :is_active');
        $this->setParameter('is_active', false);
        return $this;
    }

    public function systemLanguages()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', true);
        return $this;
    }

    public function manageableLanguages()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', false);
        return $this;
    }

    public function defaultLanguage()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isDefault = :is_default')
            ->setParameter('is_default', true)
            ->setMaxResults(1);
        return $this;
    }

    /**
     * @return LanguagesQuery
     */
    public function prioritize()
    {
        $this->addOrderBy($this->getRootAliases()[0] . '.isDefault', 'DESC');
        return $this;
    }

    /**
     * @return LanguagesQuery
     */
    public function defaultSortOrder()
    {
        $this->addOrderBy($this->getRootAliases()[0] . '.sortOrder', 'ASC');
        return $this;
    }
}
