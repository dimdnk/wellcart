<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Feature\Crud;

use Closure;
use Doctrine\ORM\EntityRepository;
use WellCart\CommandBus\Command\PersistEntity;
use WellCart\ORM\Entity;
use WellCart\ORM\ExpectedResultException;
use WellCart\Utility\Arr;

trait EntityPersistenceAwareTrait
{

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Attempt to save. If save is complete,redirect the user to the index action for the module.
     *
     * @param callable $entity
     * @param string   $messageOnCreate
     * @param string   $messageOnUpdate
     * @param  string  $route              Route name
     * @param  array   $params             Parameters to use in url generation, if any
     * @param  array   $options            RouteInterface-specific options to use in url generation, if any
     * @param  bool    $reuseMatchedParams Whether to reuse matched parameters
     *
     * @return mixed
     */
    public function attemptToPersistEntity(
        $entity,
        $messageOnCreate,
        $messageOnUpdate,
        $route = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = false
    ) {
        $isUpdate = true;
        if (is_object($entity) && method_exists($entity, 'getId')) {
            $isUpdate = (bool)$entity->getId();
        }

        if ($entity instanceof Entity) {
            $command = new PersistEntity($entity);
        } else {
            $command = $entity;
        }
        try {
            $this->commandBus()->handle($command);
            if (method_exists($command, 'getEntity')) {
                $entity = $command->getEntity();
            }
            if ($isUpdate) {
                $message = $messageOnUpdate;
            } else {
                $message = $messageOnCreate;
            }

            $this->flashMessenger()
                ->addSuccessMessage($message);

            $this->plugin('postRedirectGet')
                ->getSessionContainer()
                ->exchangeArray([]);
            if ($entity instanceof Entity && $entity->getId()) {
                $continueEdit = Arr::get(
                    $this->getRequest()->getPost(),
                    'save_and_continue_edit', false
                );
                if ($continueEdit !== false) {
                    $params = [
                        'id'     => $entity->getId(),
                        'action' => 'update',
                    ];
                }
            }

            return $this->redirect()
                ->toRoute(
                    $route,
                    $params,
                    $options,
                    $reuseMatchedParams
                );
        }
        catch (\Throwable $e) {
            $this->getLogger()
                ->emerg($e);
            if ($e instanceof \DomainException) {
                $message = $e->getMessage();
            } else {
                $message = $this->__(
                    'An unexpected error occurred. Please try again or contact Customer Support.'
                );
            }
            $this->flashMessenger()
                ->addWarningMessage($message);

            return $this->postRedirectGet();
        }
    }

    /**
     * Attempt to delete. If delete is complete,redirect the user to the index action for the module.
     *
     * @param callable $callback
     * @param string   $successMessage
     * @param  string  $route              Route name
     * @param  array   $params             Parameters to use in url generation, if any
     * @param  array   $options            RouteInterface-specific options to use in url generation, if any
     * @param  bool    $reuseMatchedParams Whether to reuse matched parameters
     *
     * @return mixed
     */
    public function attemptToDeleteEntity(
        $callback,
        $successMessage,
        $route = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = false
    ) {
        if (!$callback instanceof Closure) {
            $entity = $callback;
            $callback = function ($em) use ($entity) {
                $em->remove($entity);

                return $entity;
            };
        }

        try {
            $this->commandBus()->handle($callback);
            $this->flashMessenger()
                ->addSuccessMessage($successMessage);
        }
        catch (\Throwable $e) {
            $this->getLogger()
                ->emerg($e);

            if ($e instanceof \DomainException) {
                $message = $e->getMessage();
            } else {
                $message = $this->__(
                    'An unexpected error occurred. Please try again or contact Customer Support.'
                );
            }

            $this->flashMessenger()
                ->addWarningMessage($message);
        }

        return $this->redirect()
            ->toRoute(
                $route,
                $params,
                $options,
                $reuseMatchedParams
            );
    }

    /**
     * Perform group action. If it's complete,redirect the user to the index action for the module.
     *
     * @param  string $actionName
     * @param  array  $ids
     * @param  string $route              Route name
     * @param  array  $params             Parameters to use in url generation, if any
     * @param  array  $options            RouteInterface-specific options to use in url generation, if any
     * @param  bool   $reuseMatchedParams Whether to reuse matched parameters
     *
     * @return mixed
     */
    public function attemptToPerformGroupAction(
        $actionName,
        array $ids,
        $route = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = false
    ) {

        $result = $this->redirect()
            ->toRoute(
                $route,
                $params,
                $options,
                $reuseMatchedParams
            );

        if (!$actionName) {
            return $result;
        }

        try {
            $this->repository->performGroupAction($actionName, $ids, true);
        }
        catch (ExpectedResultException $e) {
            $successMessage = $e->getMessage();
            $this->flashMessenger()
                ->addSuccessMessage($successMessage);
        }
        catch (\Throwable $e) {
            $this->getLogger()
                ->emerg($e);

            if ($e instanceof \DomainException) {
                $message = $e->getMessage();
            } else {
                $message = $this->__(
                    'An unexpected error occurred. Please try again or contact Customer Support.'
                );
            }

            $this->flashMessenger()
                ->addWarningMessage($message);
        }

        return $result;
    }
}