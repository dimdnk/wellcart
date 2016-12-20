<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Ui\Theme;

use WellCart\Mvc\Application;
use ZeTheme\Adapter\Route;

class BackendRouteAdapter extends Route
{

    /**
     * Retrieve theme name
     *
     * @return null|string
     */
    public function getTheme()
    {
        $app = $this->serviceLocator->get('Application');
        $request = $app->getRequest();
        $router = $this->serviceLocator->get('Router');
        if (!$router->match($request)) {
            return null;
        }
        $matchedRoute = $router->match($request)->getMatchedRouteName();
        if (application_context(Application::CONTEXT_BACKEND)
            || (
                (strlen($matchedRoute) >= 8)
                && substr($matchedRoute, 0, 8) == 'zfcadmin'
            )
        ) {
            return 'wellcart-backend-ui';
        }

        return null;
    }
}
