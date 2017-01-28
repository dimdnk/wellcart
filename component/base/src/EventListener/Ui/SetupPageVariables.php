<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Ui;

use ConLayout\View\Helper\BodyClass;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\View\Helper\JavaScriptEnvironment;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\TreeRouteStack;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\View\Helper\HeadTitle;

class SetupPageVariables extends AbstractListenerAggregate
{

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'setup'],
            -100
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            [$this, 'setup'],
            -100
        );
    }

    /**
     * Setup common view helpers config for rendering page
     *
     * @param MvcEvent $e
     */
    public function setup(MvcEvent $e)
    {
        $app = $e->getApplication();
        $services = $app->getServiceManager();
        $viewHelpers = $services->get('ViewHelperManager');
        $router = $e->getRouter();
        $matches = $e->getRouteMatch();

        $this->addJsEnvironmentVariables(
            $viewHelpers->get('jsEnv'),
            $router,
            $matches
        );
        $this->addHeadTitle(
            $viewHelpers->get('headTitle'),
            $services->get('config')
        );


        $this->addHtmlBodyClasses(
            $viewHelpers->get('bodyClass'),
            $matches
        );
    }

    /**
     * Add global JS constants
     *
     * @param JavaScriptEnvironment $jsEnv
     * @param RouteStackInterface   $router
     */
    private function addJsEnvironmentVariables(
        JavaScriptEnvironment $jsEnv,
        RouteStackInterface $router,
        RouteMatch $routeMatch = null
    ) {
        if (!$router instanceof TreeRouteStack) {
            return;
        }

        $baseUrl = rtrim($router->getBaseUrl(), '/') . '/';
        $jsEnv
            ->set('baseUrl', $baseUrl)
            ->set('currentUrl', (string)$router->getRequestUri())
            ->set('assetsUrl', $baseUrl . 'assets/');
        if ($routeMatch) {
            $jsEnv->set(
                'currentRouteName',
                $routeMatch->getMatchedRouteName()
            );
        }

        $routesConfig = Config::get('router.routes', []);
        unset($routesConfig['zf-apigility'], $routesConfig['api'], $routesConfig['zfcadmin']);

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
                    $val = url_to_route($key);
                } catch (\Throwable $e) {
                    error_log($e->__toString());
                    $val = null;
                }

                return [$key, $val];
            }
        );
        unset($routesFlatConfig['']);
        $jsEnv->set('routes', $routesFlatConfig);
    }

    /**
     * Add head title
     *
     * @param HeadTitle $headTitle
     * @param array     $config
     */
    private function addHeadTitle(HeadTitle $headTitle, array $config)
    {
        $headTitle(
            Arr::get($config, 'wellcart.website.name', 'Demo Application')
        )
            ->setSeparator(' - ')
            ->setAutoEscape(false);
    }

    /**
     * Add html body classes
     *
     * @param BodyClass  $bodyClass
     * @param RouteMatch $routeMatch
     */
    private function addHtmlBodyClasses(
        BodyClass $bodyClass,
        RouteMatch $routeMatch = null
    ) {
        if ($routeMatch !== null) {
            $route = 'route-' . str_replace(
                    ['/', ':', '_', '\\'],
                    '-',
                    $routeMatch->getMatchedRouteName()
                );
            $action = 'action-' . $routeMatch->getParam('action');
            $controller = 'controller-' . str_replace(
                    ['\\', 'controller-', '::'],
                    ['-', '', '-'],
                    strtolower($routeMatch->getParam('controller'))
                );

            $bodyClass
                ->addClass($route)
                ->addClass($controller)
                ->addClass($action);
        }
    }
}
