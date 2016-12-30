<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Repository\Locale;

use WellCart\Base\Exception\DomainException;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Base\Spec\LocaleLanguageRepository;
use WellCart\ORM\AbstractRepository;

class Languages extends AbstractRepository implements LocaleLanguageRepository
{

    /**
     * @return LanguagesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('LanguageEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return LanguagesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new LanguagesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }

    /**
     * Handle default language
     *
     * @param LocaleLanguageEntity $language
     *
     * @return LocaleLanguageEntity
     */
    public function ensureDefaultLanguage(LocaleLanguageEntity $language
    ) {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('language')
        );

        $isDefault = $language->isDefault();
        if (!$isDefault) {
            $default = $this->findDefaultLanguage();
            if (is_null($default)) {
                throw new DomainException('Default language not assigned.');
            }
        } else {
            $this->connection()->executeQuery(
                'UPDATE base_locale_languages SET is_default = :is_default WHERE language_id != :id',
                ['is_default' => '0', 'id' => $language->getId(),]
            );
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('language')
        );
        return $language;
    }

    /**
     * Find default language
     *
     * @return null|LocaleLanguageEntity
     */
    public function findDefaultLanguage()
    {
        $language = $this->findOneBy(['isDefault' => true]);
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('language')
        );

        return $language;
    }
}
