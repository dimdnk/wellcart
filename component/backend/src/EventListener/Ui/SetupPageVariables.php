<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\EventListener\Ui;

use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\View\Helper\JavaScriptEnvironment;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use ZfcUser\View\Helper\ZfcUserIdentity;

class SetupPageVariables extends AbstractListenerAggregate
{

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'onRender'],
            -100
        );
    }

    /**
     * Set page title
     *
     * @param MvcEvent $e
     */
    public function onRender(MvcEvent $e)
    {
        $matches = $e->getRouteMatch();
        if ($matches === null) {
            return;
        }

        // Getting the view helper manager from the application service manager
        $viewHelperManager = $e->getApplication()
            ->getServiceManager()
            ->get('viewHelperManager');

        /**
         * @var $userIdentity ZfcUserIdentity
         */
        $userIdentity = $viewHelperManager->get('zfcUserIdentity');
        $isLogged = (bool)($userIdentity->__invoke());
        $routeName = $matches->getMatchedRouteName();
        if (!$isLogged
            || (strlen($routeName) < 7
                || substr($routeName, 0, 7) != 'backend')
        ) {
            return;
        }

        /**
         * @var $jsEnv JavaScriptEnvironment
         */
        $jsEnv = $viewHelperManager->get('jsEnv');
        $routesConfig = ['backend' => Config::get(
            'router.routes.backend',
            []
        )];
        $routesFlatConfig = Arr::flattenSeparated($routesConfig, '/');
        $routesFlatConfig = Arr::build(
            $routesFlatConfig,
            function ($key) use ($routesFlatConfig) {
                if (substr($key, -17) !== '/javascript_route') {
                    return [null, null];
                }
                $key = str_replace(
                    ['/javascript_route', '/child_routes'],
                    '',
                    $key
                );
                try {
                    $val = url_to_route($key) . ':action';
                } catch (\Throwable $e) {
                    error_log($e->__toString());
                    $val = null;
                }

                return [$key, $val];
            }
        );
        unset($routesFlatConfig['']);
        $currentRoutes = $jsEnv->get('routes', []);
        $jsEnv->set('routes', Arr::merge($currentRoutes, $routesFlatConfig));

        $rjsModules = Config::get(
            'wellcart-backend.client-side-application.modules',
            []
        );
        array_unshift($rjsModules, "assets/wellcart-backend/js/application");
        array_unique($rjsModules);
        $jsEnv->set('WellCartBackend', ['Modules' => $rjsModules]);

        // Getting the headTitle helper from the view helper manager
        $headTitleHelper = $viewHelperManager->get('headTitle');
        $headTitleHelper->append(__('Control Panel'));
    }
}
