<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc;

use Zend\Mvc\Application as AbstractApplication;

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
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     *
     * @return Application
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $context
     *
     * @return Application
     */
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
    }
}