<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc;

use WellCart\Mvc\Application\MaintenanceMode;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\Application as AbstractApplication;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

class Application extends AbstractApplication
{
    /**
     * Possible environments
     */
    const ENV_PRODUCTION = 'production';
    const ENV_DEVELOPMENT = 'development';
    const ENV_TESTING = 'testing';
    const ENV_STAGING = 'staging';
    /**
     * Possible contexts
     */
    const CONTEXT_COMMON = 'common';
    const CONTEXT_CONSOLE = 'console';
    const CONTEXT_API = 'api';
    const CONTEXT_FRONTEND = 'frontend';
    const CONTEXT_BACKEND = 'backend';
    const CONTEXT_SETUP = 'setup';
    /**
     * Special context for loading all existed modules
     */
    const CONTEXT_GLOBAL = 'global';

    /**
     * Environment
     *
     * @var string
     */
    protected $environment = self::ENV_PRODUCTION;
    /**
     * Context
     *
     * @var string
     */
    protected $context = self::CONTEXT_COMMON;

    /**
     * @var MaintenanceMode
     */
    protected $maintenanceMode;

    /**
     * @inheritDoc
     */
    public function __construct(
        $configuration,
        ServiceManager $serviceManager,
        EventManagerInterface $events = null,
        RequestInterface $request = null,
        ResponseInterface $response = null,
        $context = self::CONTEXT_GLOBAL,
        $environment = self::ENV_PRODUCTION,
        MaintenanceMode $maintenanceMode = null
    ) {
        $this->context = $context;
        $this->environment = $environment;
        $this->maintenanceMode
            = ($maintenanceMode) ? $maintenanceMode : new MaintenanceMode();
        parent::__construct(
            $configuration, $serviceManager, $events, $request, $response
        );
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return MaintenanceMode
     */
    public function getMaintenanceMode()
    {
        return $this->maintenanceMode;
    }

    /**
     * @return bool
     */
    public function enableMaintenanceMode(): bool
    {
        return $this->maintenanceMode->enable();
    }

    /**
     * @return bool
     */
    public function disableMaintenanceMode(): bool
    {
        return $this->maintenanceMode->disable();
    }

    /**
     * @return bool
     */
    public function isMaintenance(): bool
    {
        return $this->maintenanceMode->isEnabled();
    }
}