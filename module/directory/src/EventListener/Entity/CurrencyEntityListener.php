<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\EventListener\Entity;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Directory\Exception\UnprocessableEntityException;
use WellCart\Directory\Spec\CurrencyEntity;
use WellCart\Directory\Spec\CurrencyRepository;

class CurrencyEntityListener
{

    public function prePersist(
        CurrencyEntity $currency,
        LifecycleEventArgs $args
    ) {
        if ($currency->isPrimary()) {
            $currency->setStatus(CurrencyEntity::STATUS_ENABLED)
                ->setExchangeRate(1);
        }
    }

    public function preUpdate(
        CurrencyEntity $currency,
        LifecycleEventArgs $args
    ) {
        if ($currency->isPrimary()) {
            $currency->setStatus(CurrencyEntity::STATUS_ENABLED)
                ->setExchangeRate(1);
        }
    }

    public function postPersist(
        CurrencyEntity $currency,
        LifecycleEventArgs $args
    ) {
        $this->ensurePrimaryCurrency($currency, $args);
    }

    protected function ensurePrimaryCurrency(
        CurrencyEntity $currency,
        LifecycleEventArgs $args
    ) {
        /**
         * @var $repository CurrencyRepository
         */
        $repository = $args->getObjectManager()->getRepository(
            'WellCart\Directory\Spec\CurrencyEntity'
        );
        $repository->ensurePrimaryCurrency($currency);
    }

    public function postUpdate(
        CurrencyEntity $currency,
        LifecycleEventArgs $args
    ) {
        $this->ensurePrimaryCurrency($currency, $args);
    }

    public function preRemove(
        CurrencyEntity $currency
    ) {
        if ($currency->isPrimary()) {
            throw new UnprocessableEntityException(
                'Primary currency cannot be removed.'
            );
        }
    }
}
