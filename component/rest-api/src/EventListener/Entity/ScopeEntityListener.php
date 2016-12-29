<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\EventListener\Entity;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\RestApi\Entity\OAuth2\Scope as ScopeEntity;
use WellCart\RestApi\Exception\UnprocessableEntityException;
use WellCart\RestApi\Repository\OAuth2\Scopes as ScopeRepository;

class ScopeEntityListener
{
    public function postPersist(
        ScopeEntity $scope,
        LifecycleEventArgs $args
    ) {
        $this->ensureDefaultScope($scope, $args);
    }

    public function postUpdate(
        ScopeEntity $scope,
        LifecycleEventArgs $args
    ) {
        $this->ensureDefaultScope($scope, $args);
    }

    public function preRemove(
        ScopeEntity $scope
    ) {
        if ($scope->isDefault()) {
            throw new UnprocessableEntityException(
                'Default scope cannot be removed.'
            );
        }
    }

    protected function ensureDefaultScope(
        ScopeEntity $scope,
        LifecycleEventArgs $args
    ) {
        /**
         * @var $repository ScopeRepository
         */
        $repository = $args->getObjectManager()->getRepository(
          ScopeEntity::class
        );
        $repository->ensureDefaultScope($scope);
    }
}
