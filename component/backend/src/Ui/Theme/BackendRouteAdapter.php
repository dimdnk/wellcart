<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Ui\Theme;

use WellCart\Mvc\Application;
use WellCart\Ui\Theme\Adapter\Route;

class BackendRouteAdapter extends Route
{

    /**
     * Retrieve theme name
     *
     * @return null|string
     */
    public function getTheme()
    {
        if (application_context(Application::CONTEXT_BACKEND)) {
            return 'wellcart-backend-ui';
        }

        return null;
    }
}
