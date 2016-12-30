<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Router\Http\Factory;

use Interop\Container\ContainerInterface;
use WellCart\Mvc\Application;
use WellCart\Router\Http\SystemUrlRewrites;

class SystemUrlRewritesFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     *
     * @return SystemUrlRewrites
     */
    public function __invoke(ContainerInterface $container): SystemUrlRewrites
    {
        $rewrites = null;
        if (!application_context(Application::CONTEXT_SETUP)) {
            $rewrites = $container->getServiceLocator()
                ->get('WellCart\Base\Spec\UrlRewriteRepository');
        }
        return new SystemUrlRewrites($rewrites);
    }
}