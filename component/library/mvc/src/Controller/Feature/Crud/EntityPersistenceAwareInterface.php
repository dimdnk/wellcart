<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Mvc\Controller\Feature\Crud;

interface EntityPersistenceAwareInterface
{

    /**
     * Attempt to save. If save is complete,redirect the user to the index action for the module.
     *
     * @param callable $callback
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
        $callback,
        $messageOnCreate,
        $messageOnUpdate,
        $route = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = true
    );

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
        $reuseMatchedParams = true
    );
}
