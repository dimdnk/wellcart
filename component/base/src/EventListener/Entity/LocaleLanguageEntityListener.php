<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Entity;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Base\Exception\UnprocessableEntityException;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Base\Spec\LocaleLanguageRepository;

class LocaleLanguageEntityListener
{

    public function prePersist(
        LocaleLanguageEntity $language,
        LifecycleEventArgs $args
    ) {
        if ($language->isDefault()) {
            $language->setIsActive(true);
        }
    }

    public function preUpdate(
        LocaleLanguageEntity $language,
        LifecycleEventArgs $args
    ) {
        if ($language->isDefault()) {
            $language->setIsActive(true);
        }
    }

    public function postPersist(
        LocaleLanguageEntity $language,
        LifecycleEventArgs $args
    ) {
        $this->ensureDefaultLanguage($language, $args);
    }

    protected function ensureDefaultLanguage(
        LocaleLanguageEntity $language,
        LifecycleEventArgs $args
    ) {
        /**
         * @var $repository LocaleLanguageRepository
         */
        $repository = $args->getObjectManager()->getRepository(
            'WellCart\Base\Spec\LocaleLanguageEntity'
        );
        $repository->ensureDefaultLanguage($language);
    }

    public function postUpdate(
        LocaleLanguageEntity $language,
        LifecycleEventArgs $args
    ) {
        $this->ensureDefaultLanguage($language, $args);
    }

    public function preRemove(
        LocaleLanguageEntity $language
    ) {
        if ($language->isDefault()) {
            throw new UnprocessableEntityException(
                'Default language cannot be removed.'
            );
        }
    }
}
