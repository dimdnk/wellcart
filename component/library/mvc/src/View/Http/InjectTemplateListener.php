<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Mvc\View\Http;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\View\Http\InjectTemplateListener as ZendInjectTemplateListener;

class InjectTemplateListener extends ZendInjectTemplateListener
{

    /**
     * Inject a template into the view model, if none present
     *
     * Template is derived from the controller found in the route match, and,
     * optionally, the action, if present.
     *
     * @param  MvcEvent $e
     *
     * @return void
     */
    public function injectTemplate(MvcEvent $e)
    {
        $e->getRouteMatch()->setParam('action', null);
        parent::injectTemplate($e);
    }

    /**
     * Determine the top-level namespace of the controller
     *
     * @param  string $controller
     *
     * @return string
     */
    protected function deriveModuleNamespace($controller)
    {
        if (!strstr($controller, '\\')) {
            return '';
        }

        // Retrieve the first two elements representing the vendor and module name.
        $nsArray = explode('\\', $controller);
        $subNsArray = array_slice($nsArray, 0, 2);

        return implode('/', $subNsArray);
    }

    /**
     * @param $namespace
     *
     * @return string
     */
    protected function deriveControllerSubNamespace($namespace)
    {
        if (!strstr($namespace, '\\')) {
            return '';
        }
        $nsArray = explode('\\', $namespace);

        // Remove the first three elements representing the vendor, module name and controller directory.
        $subNsArray = array_slice($nsArray, 3);
        if (empty($subNsArray)) {
            return '';
        }

        return implode('/', $subNsArray);
    }
}
